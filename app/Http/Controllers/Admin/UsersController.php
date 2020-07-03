<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index()
    {
    	//if (currentUser()->can('view_dashboard')) {
	    	$users = User::all();

	    	return view('admin.users.index', compact('users'));
    	//}
    }
}
