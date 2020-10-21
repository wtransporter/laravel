<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostUpdateFormRequest;

class PostsController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if (isModerator()) {
    		$posts = Post::latest()->paginate(10);
    	} else {
            $posts = currentUser()->posts()->activated()->paginate(10);
    	}

    	return view('admin.posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dd($post->owner);
      return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
    	$this->authorize('manage', $post);
        $categories = Category::all();
    	$selectedCategories = $post->categories()->pluck('name')->toArray();
    	return view('admin.posts.edit', compact('post','selectedCategories','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Post  $post
     * @param  \Illuminate\Http\Requests\PostUpdateFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post, PostUpdateFormRequest $request)
    {

    	$attributes = [
    		'title' => $request->title,
    		'content' => hlString($request->content)
    	];

		$post->update($attributes);
		$post->categories()->sync($request->categories);

    	return redirect($post->path())->with('status', 'Post updated successfuly');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
    	return view('admin.posts.create', compact('categories'));
    }

    public function store(PostUpdateFormRequest $request)
    {
    	$post = Post::create([
    		'user_id' => currentUser()->id,
    		'title' => $request->title,
    		'content' => hlString($request->content),
    		'slug' => Str::slug($request->title, '-')
    	]);

    	$post->categories()->sync(request('categories'));

    	return redirect('/posts')->with('status', 'Post Created successfuly !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {

    	$this->authorize('manage', $post);

    	$post->delete();

    	return redirect('/posts')->with('status', 'Post deleted successfuly !');
    }
}
