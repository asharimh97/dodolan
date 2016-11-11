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
use Illuminate\Support\Facades\Auth as Auth ;

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

    // order page after choose a package, if user choose
    /**
    *
    * Order page form to handle user's request about product
    * @param $id for id package
    * @return view form
    *
    */
    public function order($id){
        $pack = DB::table('packages')->where('id_packages', '=', $id)->count() ;
        if($pack == 1)
            return 'Nanti keluar form' ;
        else
            abort(404) ;
    }

    /**
    *
    * Display setting page, to set new password, new username, profile pic? :/ maybe
    * @param $id user
    * @return setting page
    *
    */
    public function setting($id){
        if(Auth::user()->id == $id)
            return view('setting') ;
        else
            abort(404) ;
    }

    /**
    *
    * Display the recent history of the user
    * @param $id user
    * @return Response history page
    *
    */
    public function recent($id){
        return view('history') ;
    }

    /**
    *
    * Display profile page
    * @param $id
    * @return Response
    *
    */

    public function profile($id){
    	$data = User::find($id) ;
    	if($data){
    		// do if found data, progress, orders, order status, history
    		return view('profile', ['user' => $data]) ;
    	}else{
    		abort(404) ;
    	}
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
