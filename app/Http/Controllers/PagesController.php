<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
    	// $posts = Post::with('categories')
    	// 	->with('owner')
    	// 	->activated()
    	// 	->latest()
    	// 	->paginate(5);
      $posts = Post::activated()
        ->latest()
        ->paginate(4);
        
    	return view('home', compact('posts'));
    }

    public function about()
    {
    	return view('about');
    }

}
