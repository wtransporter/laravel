<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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

    public function store()
    {
  		request()->validate(['name' => 'required']);
  		
  		$category = new Category(['name' => request('name')]);

  		try {
  			$category->save();
  		} catch (QueryException $e) {
  			$error_code = $e->errorInfo[1];
  			if ($error_code == 1062) {
  				return redirect('/admin/categories/create')->withErrors('Entry already exists !');
  			}
  		}

    	return redirect('/admin/categories/create')->with('status', 'Category created successfuly !');
    }
}
