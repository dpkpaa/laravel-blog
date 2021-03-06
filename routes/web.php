<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    // Route::get('/posts', 'PostController@index')->name('posts');
    // Route::get('/posts/add-new', 'PostController@create')->name('posts.create');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    Route::resource('categories', 'CategoryController');
});
