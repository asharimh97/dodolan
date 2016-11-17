<?php

namespace App\Http\Controllers;

use App\Portfolio as Portfolio ;
use App\Testimonial ;
use App\Feedback ;
use App\Team ;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Auth ;

use App\Http\Requests;
use App\Http\Controllers\Controller ;

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
        $team = Team::where('id_team', '>', 0)
                    ->join('team_roles', 'teams.id_role', '=', 'team_roles.id_role')
                    ->get() ;
    	return view('rumah', [ 'galleries' => $gallery, 'testimonies' => $testimoni, 'teams' => $team]) ;
    }

    public function faq(){
        return view('faq') ;
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

    public function postcontact(Request $request){
        $this->validate($request, [
                'title' => 'required|min:10|max:255',
                'name' => 'required|min:6|max:255',
                'email' => 'required|email|max:255|unique:feedbacks',
                'feedback' => 'required|min:20'
            ]) ;
        $time = date("Y-m-d H:i:s") ;
        $ins = Feedback::create([
                'title' => $request->title,
                'name' => $request->name,
                'email' => $request->email,
                'feedback' => $request->feedback,
                'created_at' => $time
            ]) ;

        if($ins){
            return redirect('contact') ;
        }else{
            abort(503) ;
        }
    }
}
