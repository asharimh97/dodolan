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

Route::post('/feedback', 'BaseController@postcontact') ;

Route::get('/order', 'BaseController@order');

Route::get('/faq', 'BaseController@faq');

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

Route::get('/order/invoice/{id}', 'UserController@invoice') ;

/* Admin Controller */
Route::get('/admin', function(){
	return redirect('admin/login') ;
}) ;

Route::get('/dashboard', 'AdminController@index') ;

Route::get('/admin/orders', 'AdminController@orders') ;

Route::get('/admin/users', 'AdminController@users') ;

Route::get('admin/user/delete/{id}', 'AdminController@deleteUser') ;

Route::get('/admin/portfolios', 'AdminController@portfolios') ;

Route::get('/admin/testimonials', 'AdminController@testimonials') ;

Route::get('/admin/feedbacks', 'AdminController@feedbacks') ;

Route::get('/admin/feedback/view/{id}', 'AdminController@viewFeedback') ;

Route::get('/admin/feedback/delete/{id}', 'AdminController@deleteFeedback') ;

Route::get('/admin/teams', 'AdminController@teams') ;

Route::get('/adminreg', 'AdminController@daftar') ;

Route::post('/post', 'AdminController@simpan') ;

Route::get('/adminupdate/{id}', 'AdminController@update') ;

Route::post('/edit', 'AdminController@edit') ;

Route::get('/admin/login', 'AdminController@login') ;

Route::post('/admin/login_pr', 'AdminController@checkLog') ;
