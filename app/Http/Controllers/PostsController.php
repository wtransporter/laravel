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
    	if (currentUser()->hasRole('moderator')) {
    		$posts = Post::all();
    	} else {
    		$posts = Post::where('activated', 1)->get();
    	}

    	return view('admin.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
    	return view('admin.posts.show', compact('post'));
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
    		'categories' => 'requred'
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

    public function destroy(Post $post)
    {
    	
    	$this->authorize('manage', $post);

    	$post->delete();

    	return redirect('/posts')->with('status', 'Post deleted successfuly !');
    }
}
