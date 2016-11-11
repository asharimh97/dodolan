<?php

namespace App\Http\Controllers;

use App\Portfolio as Portfolio ;
use App\Testimonial ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;

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
    	$testimoni = Testimonial::join('users', 'testimonials.id_user', '=', 'users.id')
    						->where('id_testi', '>', '0')
    						->orderBy('rating', 'desc')
    						->limit(3)
    						->get() ;
    	return view('rumah', [ 'galleries' => $gallery, 'testimonies' => $testimoni ]) ;
    }

    public function order(){
        $order = DB::table('packages')->get() ;
    	return view('order', ['packages' => $order]) ;
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
