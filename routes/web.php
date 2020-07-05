<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 		'PagesController@home');

Route::get('/about', 	'PagesController@about');

Route::group(['middleware' => 'auth'], function () {
	// Route::get('/tickets', 			'TicketsController@index');
	// Route::get('/tickets/create', 	'TicketsController@create');
	// Route::get('/tickets/{ticket}', 		'TicketsController@show');
	// Route::get('/tickets/{ticket}/edit', 	'TicketsController@edit');	
	// Route::patch('/tickets/{ticket}', 'TicketsController@update');
	// Route::post('/tickets', 		'TicketsController@store');
	// Route::delete('/tickets/{ticket}', 		'TicketsController@destroy');
	Route::resource('tickets', 'TicketsController');

	Route::get('/posts', 		'PostsController@index');
	Route::get('/posts/create', 'PostsController@create');
	Route::get('/posts/{post}', 'PostsController@show');
	Route::post('/posts', 		'PostsController@store');
	Route::patch('/posts/{post}','PostsController@update');
	Route::delete('/posts/{post}','PostsController@destroy');

	Route::post('/comments/{ticket}', 		'CommentsController@store');
});

Route::group([
		'prefix'=> 'admin', 'namespace' => 'Admin', ['middleware' => 'auth']
	], function () {
	
	Route::get('users', 'UsersController@index')->middleware('can:view_dashboard');
	Route::get('/', 	'PagesController@index')->middleware('can:view_dashboard');

	Route::get('/roles', 'RolesController@index');
	Route::get('/roles/create', 'RolesController@create');
	Route::get('/roles/{role}', 'RolesController@show');
	Route::get('/roles/{role}/edit', 'RolesController@edit');
	Route::post('/roles', 'RolesController@store');

	Route::get('/abilities', 'AbilitiesController@index')->middleware('can:view_dashboard');
	Route::get('/abilities/create', 'AbilitiesController@create');
	Route::post('/abilities', 'AbilitiesController@store');

	Route::get('/categories',		'CategoriesController@index')->middleware('can:view_dashboard');
	Route::get('/categories/create','CategoriesController@create');
	Route::post('/categories',		'CategoriesController@store');

});

	Auth::routes();