<?php

namespace App\Http\Controllers;

use App\Admin ;
use App\Order ;
use App\Portfolio ;
use App\Testimonial ;
use App\User ;
use App\Feedback ;
use App\Team ;
use App\Proposal ;

use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Http\RedirectResponse ;
use Illuminate\Http\UploadedFile ;
use Illuminate\Http\File ;
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

    public function detailOrder($id){
        $data = Order::where('id_order', $id) ;
        if($data->count() == 1){
            $order = $data->join('users', 'orders.id_user', '=', 'users.id')
                        ->first() ;
            $samples = DB::table('order_details')
                            ->where('order_details.id_order', '=', $id)
                            ->join('portfolios', 'order_details.id_portfolio_sample', '=', 'portfolios.id_portfolios')
                            ->get() ;
            $props = Proposal::where('id_order', $id)->get() ;
            return view('admin.detailorder', ['order' => $order, 'samples' => $samples, 'props' => $props]) ;
        }
        else
            abort(404) ;
    }

    public function proposalOrder($id){
        $data = Order::where([
                    ['id_order', $id],
                    ['status', 'OWIP']]) ;
        if($data->count() == 1){
            $order = $data->first() ;
            return view('admin.proposalorder', ['order' => $order]) ;
        }else{
            abort(404) ;
        }
        // return 'form proposal untuk id = '.$id ;
    }

    public function submitProposalOrder(Request $request){
        $this->validate($request, [
                'pic' => 'required',
                'desc' => 'required'
            ]) ;
        $date = date('Y-m-d H:i:s') ;
        $ext = $request->pic->extension() ;
        if($ext == 'jpeg' || $ext == 'png'){
            // file extension accepted, insert proposal, change to proposed
            $path = $request->pic->store('proposals') ;
            $ins = Proposal::create([
                    'picture' => $path,
                    'description' => $request->desc,
                    'status' => 'Submitted',
                    'id_order' => $request->id,
                    'created_at' => $date
                ]) ;
            $order = Order::where('id_order', $request->id)->update(['status' => 'PROP']) ;

            if($ins){
                return redirect('admin/order/detail/'.$request->id) ;
            }else{
                abort(503) ;
            }
        }else{
            abort(406) ;
        }
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
        // $data = Order::where([
        //         ['id_order', $id],
        //         ['status', 'SBMT']
        //         ]) ;
        $data = Order::where('id_order', $id) ;
        if($data->count() == 1){
            $order = $data->first() ;
            if($order->status == 'SBMT'){
                // if status submitted, set price
                $data = $data->join('packages', 'orders.id_packages', '=', 'packages.id_packages')
                             ->join('jenis_designs', 'orders.id_jenis', '=', 'jenis_designs.id_design')
                             ->first() ;
                return view('admin.approve_order', ['order' => $data]) ;

            }else if($order->status == 'PAID' || $order->status == 'RVSD'){
                // if paid, set to WIP
                $upd = $data->update(['status' => 'OWIP']) ;
                if($upd){
                    return redirect('admin/orders') ;
                }else{
                    abort(503) ;
                }
            }
        }else{
            abort(404) ;
        }
    }

    public function approveOrderPost(Request $request){
        // give price and change status to confirmed (CONF)
        $this->validate($request, [
            'price' => 'required'
            ]) ;

        $order = Order::where('id_order', $request->id_order) ;
        if($order->count() == 1){
            $price = $request->price ;
            if($price >= $request->min_price && $price <= $request->max_price){
                // price valid
                $upd = $order->update(['price' => $price, 'status' => 'CONF']) ;
                if($upd){
                    return redirect('admin/orders') ;
                }else{
                    abort(503) ;
                }
            }else{
                abort(403) ;
            }
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
        // reject payment if not valid
        $pay = DB::table('payments')->where([
                    ['id_order', $id],
                    ['payment_status', 'On process']
                    ]) ;
        if($pay->count() == 1){
            $path = $pay->first() ;
            // $delfile = File::delete(public_path().'uploads/'.$path->picture) ;
            $delfile = unlink(public_path('uploads/'.$path->picture)) ;
            $pay = $pay->update(['payment_status' => 'Rejected', 'picture' => '']) ;
            $stat = Order::where('id_order', $id)->update(['status' => 'PYRJ']) ;

            return redirect('admin/orders') ;
        }else{
            abort(404) ;
        }
    }

    public function approvePayment($id){
        // return page to confirm payment, data given is order, brief, payment proof, and status that time
        $pay = DB::table('payments')->where([
                    ['id_order', $id],
                    ['payment_status', 'On process']
            ]) ;
        if($pay->count() == 1){
            $pay = $pay->update(['payment_status' => 'Confirmed']) ;
            $order = Order::where('id_order', $id)->update(['status' => 'PAID']) ;
            if($pay){
                return redirect('admin/orders') ;
            }
        }else{
            abort(404) ;
        }
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
