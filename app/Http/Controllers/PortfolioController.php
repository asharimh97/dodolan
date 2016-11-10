<?php

namespace App\Http\Controllers;

use App\Portfolio ;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Http\RedirectResponse ;
use Illuminate\Http\UploadedFile ;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Storage ;

use App\Http\Requests;

class PortfolioController extends Controller
{
    // TO DO 9/11/2016 : Make a controller for portfolio such as add new portfolio, delete portfolio

    public function __construct(){
    	// constructor function
    	$this->middleware('auth') ;
    }

	public function upload(){
		$jenis = DB::table('jenis_designs')->get() ;
		return view('upload', ['jenis' => $jenis]) ;
	}

	public function lorem($data){
		return $data ;
	}

	/**
	*
	* Method to store the file upload data into database and rewite in path
	* @param Request $request
	* @return Response
	*
	*/

	public function fileupload(Request $request){
		// File upload method store the data to database
		$this->validate($request, [
				'title' => 'required|min:3|max:255',
				'desc' => 'required',
				'rating' => 'required',
				'jenis' => 'required',
				'foto' => 'required'
			]) ;

		$ext = $request->foto->extension() ;

		if($ext == 'jpeg' || $ext == 'png'){
			// simpan
			$path = $request->foto->store('images/portfolio') ;
			$ins = Portfolio::create([
					'title' => $request->title,
					'description' => $request->desc,
					'id_user' => $request->userid,
					'rating' => $request->rating,
					'id_jenis_design' => $request->jenis,
					'picture' => $path,
				]) ;

			if($ins){
				$data = 'Berhasil' ;
				return redirect('upload') ;
			}else{
				$data = 'Gagalupload' ;
			}
		}else{
			$data = 'File extension not supported' ;
		}

		return redirect('/lorem/'.$data) ;
	}
}
