<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesPostsController extends Controller
{

	/**
     * Display a listing of the resource.
     *
	 * @param Category $category
     * @return \Illuminate\Http\Response
     */
	public function index(Category $category)
    {    	
    	$posts = $category->posts()->with('owner')->paginate(5);

    	return view('categories_posts.index', [
    			'posts' => $posts,
    			'categoryName' => $category->name
    		]);
    }

}
