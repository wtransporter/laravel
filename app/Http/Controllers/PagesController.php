<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
    	$posts = Post::with('categories')
    		->with('owner')
    		->where('activated', 1)
    		->latest()
    		->paginate(5);
    	return view('home', compact('posts'));
    }

    public function about()
    {
    	return view('about');
    }
    
}
