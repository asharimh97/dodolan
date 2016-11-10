<?php

namespace App\Http\Controllers;

use App\Admin ;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Http\RedirectResponse ;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Hash ;

use App\Http\Requests;
use App\Http\Controllers\Controller ;

class AdminController extends Controller
{
    // TO DO 8/11/2016 : Controller for admin

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
