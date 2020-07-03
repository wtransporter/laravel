<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::all();
    	return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
    	$categories = Category::all();
    	return view('admin.posts.create', compact('categories'));
    }

    public function store()
    {
    	request()->validate([
    		'title' => 'required',
    		'content' => 'required',
    		'category' => 'requred'
    	]);

    	$post = new Post([
    		'user_id' => currentUser()->id,
    		'title' => request('title'),
    		'content' => request('content'),
    		'slug' => uniqid()
    	]);

    	$post->save();

    	$post->categories()->sync(request('categories'));

    	return redirect('/posts/create')->with('status', 'Post Created successfuly !');
    }
}
