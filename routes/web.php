<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/* Base page routes */

Route::get('/', 'BaseController@index');

Route::get('/about', 'BaseController@about');

Route::get('/gallery', 'BaseController@gallery');

Route::get('/contact', 'BaseController@contact');

Route::get('/order', 'BaseController@order');

Route::get('/hello', function(){
	return view('navs') ;
}) ;

/* Portfolio routes */
Route::get('/upload', 'PortfolioController@upload') ;

Route::post('/fileupload', 'PortfolioController@fileupload') ;

Route::get('/lorem/{data}', 'PortfolioController@lorem') ;

/* Auth routes */

Auth::routes();

Route::get('/home', 'UserController@index');

Route::get('/profile/{id}', 'UserController@profile') ;

Route::get('/testi', 'UserController@testi') ;

Route::post('/testimoni', 'UserController@testimoni') ;

Route::get('/order/{id}', 'UserController@order') ;

Route::get('/order/detail/{id}', 'UserController@detail') ;

Route::post('/orderpost', 'UserController@orderpost') ;

Route::get('/setting/{id}', 'UserController@setting') ;

Route::get('/setting/{id}/{response}', 'UserController@settings') ;

Route::post('/update', 'UserController@update') ;

Route::get('/recent/{id}', 'UserController@recent') ;

/* Admin Controller */
Route::get('/admin', function(){
	return redirect('admin/login') ;
}) ;

Route::get('/adminreg', 'AdminController@daftar') ;

Route::post('/post', 'AdminController@simpan') ;

Route::get('/adminupdate/{id}', 'AdminController@update') ;

Route::post('/edit', 'AdminController@edit') ;

Route::get('/admin/login', 'AdminController@login') ;

Route::post('/admin/login_pr', 'AdminController@checkLog') ;
