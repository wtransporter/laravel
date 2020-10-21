<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	$search = '%'.$request->get('search').'%';
		$posts = Post::activated()->userSearch($search);
		
    	return view('home', compact('posts'));
    }
}
