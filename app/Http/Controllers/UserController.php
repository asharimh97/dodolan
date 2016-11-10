<?php

namespace App\Http\Controllers;

use App\User ;
use App\Testimonial ;
use App\Portfolio ;
use App\Order ;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Http\RedirectResponse ;
use Illuminate\Support\Facades\DB ;

use App\Http\Requests;
use App\Http\Controllers\Controller ;

class UserController extends Controller
{
    // TO DO 8/11/2016 : Make user controller when a user has been logged in

    public function __construct(){
    	$this->middleware('auth') ;
    }

    public function index(){
    	return view('home') ;
    }

    public function testi(){
    	return view('testimoni') ;
    }

    /**
    *
    * Store testimonials user about the project a user can only do testimonials once
    * @param Request $request
    * @return Response
    *
    */

    public function testimoni(Request $request){
    	$this->validate($request,[
    			'id_user' => 'required|unique:testimonials',
    			'desc' => 'required|max:300',
    			'rating' => 'required',
    			'unique_code' => 'required|unique:testimonials',
    		]) ;

    	$userid = $request->input('id_user') ;
    	$ins = Testimonial::create([
    			'id_user' => $userid,
    			'testimoni_desc' => $request->desc,
    			'rating' => $request->rating,
    			'unique_code' => $request->unique_code
    		]) ;

    	if($ins) return redirect('testi') ;
    	else return redirect('lorem/gagal') ;
    }
}
