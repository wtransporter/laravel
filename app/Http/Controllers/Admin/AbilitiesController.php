<?php

namespace App\Http\Controllers\Admin;

use App\Ability;
use App\Http\Controllers\Controller;
use App\Http\Requests\AbilityFormRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AbilitiesController extends Controller
{
    public function index()
    {
    	$abilities = Ability::all();
    	return view('admin.abilities.index', compact('abilities'));
    }

    public function create()
    {
    	return view('admin.abilities.create');
    }

    public function store(AbilityFormRequest $request)
    {
    	$attributes = $request->validated();

    	try {

    		Ability::create($attributes);

    	} catch (QueryException $e) {
			$error_code = $e->errorInfo[1];
			if($error_code == 1062){
				return redirect('/admin/abilities/create')->withErrors(['Entry already exists!']);
			}
        }

    	return redirect('/admin/abilities/create')->with('status', 'Ability created successfuly !');
    }
}
