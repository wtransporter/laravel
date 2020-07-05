<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
    	$posts = Post::where('activated', 1)->paginate(10);
    	return view('home', compact('posts'));
    }

    public function about()
    {
    	return view('about');
    }
    
}
