<?php

namespace App\Http\Controllers;

use App\Portfolio as Portfolio ;

use Illuminate\Http\Request;

use App\Http\Requests;

class BaseController extends Controller
{
    // TO DO 8/11/2016 : Make base controller for general page which can be accessed whether not logged in
    
    public function index(){
    	$gallery = Portfolio::where('id_portfolios', '>', '0')
    					//->orderBy('rating', 'desc')
    					->inRandomOrder()
    					->limit(8)
    					->get() ;
    	return view('rumah', ['galleries' => $gallery]) ;
    }

    public function order(){
    	return view('order') ;
    }

    public function gallery(){
    	$data = Portfolio::all() ;
    	return view('gallery', ['galleries' => $data]) ;
    }

    public function about(){
    	return view('about') ;
    }

    public function contact(){
    	return view('contact') ;
    }
}
