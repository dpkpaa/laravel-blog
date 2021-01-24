<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->with(['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|unique:posts,title',
            'body' => 'required',
            'image' => 'sometimes|mimes:png,jpg',
            'category_id' => 'required',
            'tags' => 'required',
        ]);
        // dd($validatedData);
        // dd($request->all());
        // $post = new Post;
        // $post->user_id = auth()->user()->id;
        // $post->title = $validatedData['title'];
        // $post->body = $validatedData['body'];
        // // $post->body = $request->body;
        // $post->save();

        //Image upload
        if ($request->has('image')) {
            // $fileName = Str::slug($validatedData['title']) . '.' . $request->image->getClientOriginalExtension();
            // $path = $request->image->storeAs('upload', $fileName, ['disk' => 'public']);
            $path = $request->image->store('upload', ['disk' => 'public']);
            $validatedData['image_path'] = $path;
        }

        $post = auth()->user()->posts()->create($validatedData);
        $post->tags()->attach($validatedData['tags']);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();


        return view('posts.edit')->with(['categories' => $categories, 'tags' => $tags, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($post->image_path);
        $validatedData = $request->validate([
            'title' => 'required|unique:posts,title,' . $post->id,
            'body' => 'required',
            'image' => 'sometimes|mimes:png,jpg',
            'category_id' => 'required',
            'tags' => 'required',
        ]);


        $onlyFields =  collect($validatedData)->only(['title', 'body', 'category_id'])->toArray();
        $oldFile = $post->image_path;
        if ($request->has('image')) {
            // $fileName =  Str::slug($validatedData['title'] . ' ' . Str::random(10)) . '.' . $request->image->getClientOriginalExtension();
            // $path = $request->image->storeAs('upload', $fileName, ['disk' => 'public']);
            $path = $request->image->store('upload', ['disk' => 'public']);
            $onlyFields['image_path'] = $path;

            Storage::disk('public')->delete($oldFile);
        }


        $post->update($onlyFields);

        $post->tags()->sync($validatedData['tags']);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
