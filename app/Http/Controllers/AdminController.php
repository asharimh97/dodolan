<?php

namespace App\Http\Controllers;

use App\Admin ;
use App\Order ;
use App\Portfolio ;
use App\Testimonial ;
use App\User ;
use App\Feedback ;
use App\Team ;

use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Http\RedirectResponse ;
use Illuminate\Http\UploadedFile ;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Storage ;

use App\Http\Requests;
use App\Http\Controllers\Controller ;

class AdminController extends Controller
{
    // TO DO 8/11/2016 : Controller for admin
    public function __construct(){
    	$this->middleware('admin') ;
    }

    /**
    *
    * Collection of user CRUD
    *
    */
    public function index(){
        $data = User::all() ;
    	return view('admin.home', ['users' => $data]) ;
    }

    public function deleteUser($id){
        $data = User::find($id) ;
        if($data){
            $user = User::where('id', $id)->delete() ;
            if($user){
                return redirect('dashboard') ;
            }else{
                abort(503) ;
            }
        }else{
            abort(404) ;
        }
    }

    /**
    *
    * Collection of order CRUD
    *
    */
    public function orders(){
        $data = Order::all() ;
        return view('admin.order', ['orders' => $data]) ;
    }

    public function rejectOrder($id){
        $data = Order::where([
                ['id_order', $id],
                ['status', 'SBMT']
                ]) ;
        if($data->count() == 1){
            $rjc = $data->update(['status' => 'RJCT']) ;
            if($rjc){
                return redirect('admin/orders') ;
            }else
                abort(503) ;
        }else{
            abort(404) ;
        }
    }

    public function approveOrder($id){
        $data = Order::where([
                ['id_order', $id],
                ['status', 'SBMT']
                ]) ;
        if($data->count() == 1){
            $conf = $data->update(['status' => 'CONF', 'price' => '850000']) ;
            if($conf){
                return redirect('admin/orders') ;
            }else
                abort(503) ;
        }else{
            abort(404) ;
        }
    }

    public function deleteOrder($id){
        $data = Order::where('id_order', $id) ;
        if($data->count() == 1){
            $del = $data->delete() ;
            if($del){
                return redirect('admin/orders') ;
            }else{
                abort(503) ;
            }
        }else{
            abort(404) ;
        }
    }

    /**
    *
    * Collection of payment CRUD
    *
    */
    public function payments(){
        $data = DB::table('payments')
                    ->where('payments.id_order', '>', 0)
                    ->join('orders', 'payments.id_order', '=', 'orders.id_order')
                    ->join('users', 'orders.id_user', '=', 'users.id')
                    ->get() ;

        return view('admin.payment', ['payments' => $data]) ;
    }

    public function rejectPayment($id){
        return 'reject payment' ;
    }

    public function approvePayment($id){
        return 'approve payment' ;
    }

    /**
    *
    * Collection of portfolio CRUD
    *
    */
    public function portfolios(){
        $data = Portfolio::where('id_portfolios', '>', 0)
                           ->join('jenis_designs', 'portfolios.id_jenis_design', '=', 'jenis_designs.id_design')
                           ->join('users', 'portfolios.id_user', '=', 'users.id')
                           ->get() ;
        return view('admin.portfolio', ['portfolios' => $data]) ;
    }

    /**
    *
    * Collection of testimonial CRUD
    *
    */
    public function testimonials(){
        $data = Testimonial::where('id_testi', '>', 0)
                            ->join('users', 'testimonials.id_user', '=', 'users.id')
                            ->get() ;
        return view('admin.testimonial', ['testimonials' => $data]) ;
    }

    /**
    *
    * Collection of feedbacks CRUD
    *
    */
    public function feedbacks(){
        $data = Feedback::all() ;
        return view('admin.feedback', ['feedbacks' => $data]) ;
    }

    public function deleteFeedback($id){
        $data = Feedback::find($id) ;
        if($data){
            $delete = Feedback::where('id', $id)->delete() ;
            if($delete)
                return redirect('admin/feedbacks') ;
            else
                abort(503) ;
        }
        else
            abort(404) ; 
    }

    /**
    *
    * Collection of team CRUD
    *
    */
    public function teams(){
        $data = Team::where('id_team', '>', 0)
                      ->join('team_roles', 'teams.id_role', '=', 'team_roles.id_role')
                      ->get() ;
        return view('admin.team', ['teams' => $data]) ;
    }

    public function viewTeam($id){
        $data = Team::where('id_team', $id) ;
        if($data->count() == 1){
            $data = $data->join('team_roles', 'teams.id_role', '=', 'team_roles.id_role')
                         ->first() ;

            return view('admin.profile', ['team' => $data]) ;
        }else
            abort(404) ;
    }

    public function editTeam($id){
        $data = Team::where('id_team', $id) ;
        if($data->count() == 1){
            $data = $data->join('team_roles', 'teams.id_role', '=', 'team_roles.id_role')
                         ->first() ;

            return view('admin.teamsetting', ['team' => $data]) ;
        }else
            abort(404) ;
    }

    public function deleteTeam($id){
        return 'Delete team' ;
    }
    // End of CRUD collection

    public function daftar(){
    	$roles = DB::table('admin_roles')->get() ;
    	return view('admin.register', ['roles' => $roles]) ;
    }

    public function update($id){
    	$table = Admin::find($id) ;
    	if($table){

	    	$roles = DB::table('admin_roles')->get() ;
	    	$roleas = DB::table('admin_roles')->where('id_roles', $table->role_id)->get() ;
	    	return view('admin.update', ['roles' => $roles, 'data' => $table]) ;

    	}else{
    		abort(404) ;
    	}
    }

    public function login(){
    	return view('admin.login') ;
    }

    public function checkLog(Request $request){
    	// TO DO 9/11/2016 : check to the database whether there is password and username/email
    	$this->validate($request,[
    			'email' => 'required',
    			'password' => 'required'
    	]) ;

    	$query = Admin::where('email', $request->email)->get() ;
    	if($query){
    		// jika data ada 
    		$passCheck = Hash::check($request->password, $query->password) ;
    		if($passCheck){
    			// buat session, redirect ke halaman lain
    		}else{
    			// redirect ke login lagi
    		}
    	}else{
    		// redirect ke login lagi
    	}
    }


    /**
	* Store a new admin member
	*
	* @param Request $request
	* @return Response
	*
    **/

    public function simpan(Request $request){
    	// validate and then store admin data

    	$this->validate($request,[
    			'name' => 'required|min:6|max:255',
    			'email' => 'required|email|max:255|unique:admins',
    			'username' => 'required|min:6|max:25|unique:admins',
    			'password' => 'required|min:6|confirmed',
    			'gender' => 'required',
    			'telp' => 'required|min:10|max:14',
    			'roles' => 'required',
    		]) ;

    	$ins = Admin::create([
    		'nama' => $request->name,
    		'email' => $request->email,
    		'username' => $request->username,
    		'password' => bcrypt($request->password),
    		'gender' => $request->gender,
    		'telp' => $request->telp,
    		'prof_pic' => '',
    		'role_id' => $request->roles
    		]) ;

    	if($ins){
    		// berhasil insert data
    		return redirect()->route('/') ;
    	}else{
    		return redirect()->route('/adminreg') ;
    	}

    }

    // TO DO 9/11/2016
    /**
    *
    * Store updated data to database, if password empty don't change it
    * @param Request $request
    * @return Response
    *
    */

    public function edit(Request $request){
    	$this->validate($request,[
    			'name' => 'required|min:6|max:255',
    			'email' => 'required|email|max:255',
    			'username' => 'required|min:6|max:25',
    			'gender' => 'required',
    			'telp' => 'required|min:10|max:14',
    			'roles' => 'required',
    		]) ;
    	$admin = Admin::find($request->id) ;
    	if(empty($request->password)){
    		// edit the data without edit the password and change the updated_at
    		$admin->nama = $request->name ;
    		$admin->email = $request->email ;
    		$admin->username = $request->username ;
    		$admin->gender = $request->gender ;
    		$admin->telp = $request->telp ;
    		$admin->role_id = $request->roles ;
    	}else{
    		// edit the data within edit the password and change the updated_at
    		$admin->nama = $request->name ;
    		$admin->email = $request->email ;
    		$admin->username = $request->username ;
    		$admin->password = bcrypt($request->password) ;
    		$admin->gender = $request->gender ;
    		$admin->telp = $request->telp ;
    		$admin->role_id = $request->roles ;
    	}

    	if($admin->save()){
    		// if data saved do redirect to update and with id same
    		return redirect('/') ;
    	}else{
    		return redirect('adminreg') ;
    	}
    }
}
