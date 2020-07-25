<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    public function index()
    {
    	if (isModerator()) {
    		$posts = Post::with('owner')->latest()->paginate(10);
    	} else {
    		$posts = Post::where([
    				'activated' => 1,
    				'user_id' => currentUser()->id
    			])->paginate(10);;
    	}

    	return view('admin.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
    	return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
    	$this->authorize('manage', $post);
        $categories = Category::all();
    	$selectedCategories = $post->categories()->pluck('name')->toArray();
    	return view('admin.posts.edit', compact('post','selectedCategories','categories'));
    }

    public function update(Post $post)
    {
    	request()->validate([
    		'title' => 'required',
    		'content' => 'required',
    		'categories' => 'required'
    	]);

    	$attributes = [
    		'title' => request('title'),
    		'content' => hlString(request('content'))
    	];
		
		$post->update($attributes);
		$post->categories()->sync(request('categories'));

    	return redirect($post->path())->with('status', 'Post updated successfuly');
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
    		'categories' => 'required'
    	]);
    	
    	$post = new Post([
    		'user_id' => currentUser()->id,
    		'title' => request('title'),
    		'content' => hlString(request('content')),
    		'slug' => uniqid()
    	]);
    	
    	$post->save();

    	$post->categories()->sync(request('categories'));

    	return redirect('/posts')->with('status', 'Post Created successfuly !');
    }

    public function destroy(Post $post)
    {
    	
    	$this->authorize('manage', $post);

    	$post->delete();

    	return redirect('/posts')->with('status', 'Post deleted successfuly !');
    }
}
