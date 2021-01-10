@extends('layouts.admin')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add New Post</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">New Post</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
      <div class="container-fluid">
<div class="card">
    <div class="card-header">
<div class="card-body">
      <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
          @error('title')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
          @enderror
          
        </div>
        <div class="form-group">
          <label for="text-editor">Body</label>
          <textarea  class="form-control @error('body') is-invalid @enderror" name="body" rows="8" id="text-editor" ></textarea>
          @error('body')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
          @enderror
        </div>
        <div class="input-group @error('image') is-invalid @enderror">
          <div class="custom-file">
            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror " id="inputGroupFile02">
            <label class="custom-file-label" for="inputGroupFile02" >Choose file</label>
            
          </div>
        
        </div>
          @error('image')
          <div class="invalid-feedback">
            {{ $message}}
          </div>
        @enderror
        
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
    </div>
    </div>
  </div>
  
</div>
</section>
@endsection