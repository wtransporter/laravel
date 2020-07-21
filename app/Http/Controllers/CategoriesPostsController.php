<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesPostsController extends Controller
{
    public function index(Category $category)
    {    	
    	$posts = $category->posts()->with('owner')->paginate(5);

    	//$posts = $category->posts();

    	return view('categories_posts.index', [
    			'posts' => $posts,
    			'categoryName' => $category->name
    		]);
    }
}
