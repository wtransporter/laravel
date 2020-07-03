<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;
use App\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
    	$roles = Role::all();
    	return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
    	return view('admin.roles.create');
    }

    public function store(RoleFormRequest $request)
    {

    	$attributes = $request->validated();

    	try {
    		Role::create($attributes);
    	} catch (QueryException $e) {
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                return redirect('/admin/roles/create')->withErrors(['Role "'. $request->name.'" already exists!']);
            }
        }

    	return redirect('/admin/roles/create')->with('status', 'Role created successfuly !');
    }
}
