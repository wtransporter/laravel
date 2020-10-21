<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
	/**
	 * Display list of active posts on home page
	 */
	public function home()
    {
    	$posts = Post::activated()
			->latest()
			->paginate(20);
        
    	return view('home', compact('posts'));
    }

	/**
	 * Display about page
	 */
	public function about()
    {
    	return view('about');
    }

}
