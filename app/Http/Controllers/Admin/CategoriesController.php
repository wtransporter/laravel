<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\CategoryStoreRequest;

class CategoriesController extends Controller
{
    public function index()    
    {
    	$categories = Category::all();
    	return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
    	return view('admin.categories.create');
    }

	/**
	 * Store a new category instance
	 * 
	 * @param CategoryStoreRequest $request
	 */
	public function store(CategoryStoreRequest $request)
    {
  		try {

			Category::create(['name' => $request->name]);

  		} catch (QueryException $e) {
  			$error_code = $e->errorInfo[1];
  			if ($error_code == 1062) {
  				return redirect('/admin/categories/create')->withErrors('Entry already exists !');
  			}
  		}

    	return redirect('/admin/categories/create')->with('status', 'Category created successfuly !');
    }
}
