<?php

namespace App\Http\Controllers;

use App\User ;
use App\Testimonial ;
use App\Portfolio ;
use App\Order ;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Http\RedirectResponse ;
use Illuminate\Http\UploadedFile ;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Storage ;
use Illuminate\Support\Facades\Auth as Auth ;
use Illuminate\Support\Collection ;

use App\Http\Requests;
use App\Http\Controllers\Controller ;

class UserController extends Controller
{
    // TO DO 8/11/2016 : Make user controller when a user has been logged in

    public function __construct(){
    	$this->middleware('auth') ;
    }

    public function convertDate($date){
        $thn = substr($date, 0, 4) ;
        $bln = substr($date, 5, 2) ;
        $tgl = substr($date, 8, 2) ;
        $blne ;
        switch($bln){
            case 1 : $blne = "January"; break ;
            case 2 : $blne = "February"; break ;
            case 3 : $blne = "March"; break ;
            case 4 : $blne = "April"; break ;
            case 5 : $blne = "May"; break ;
            case 6 : $blne = "June"; break ;
            case 7 : $blne = "July"; break ;
            case 8 : $blne = "August"; break ;
            case 9 : $blne = "September"; break ;
            case 10 : $blne = "October"; break ;
            case 11 : $blne = "November"; break ;
            case 12 : $blne = "December"; break ;
        }

        return $tgl.' '.$blne.' '.$thn ;
    }

    public function index(){
        $data = DB::table('orders')
                    ->join('users', 'orders.id_user', '=', 'users.id')
                    ->join('packages', 'orders.id_packages', '=', 'packages.id_packages')
                    ->join('order_status', 'orders.status', '=', 'order_status.id_status')
                    ->where('users.id', Auth::user()->id) ;
        $count = $data->count() ;
        $data = $data->get() ;
    	return view('home', ['user' => $data, 'count' => $count]) ;
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
        $jenis = DB::table('jenis_designs')->get() ;
        $sample = Portfolio::where('id_portfolios', '>', '0')
                            ->inRandomOrder()
                            ->limit(12)
                            ->get() ;
        if($pack == 1)
            return view('order2', ['id' => $id, 'samples' => $sample, 'jenis' => $jenis]) ;
        else
            abort(404) ;
    }

    /**
    *
    * Store the data order to database
    * @param Request $request
    * @return Response
    *
    */
    public function orderpost(Request $request){
        $this->validate($request, [
                'title' => 'required|max:255',
                'brief' => 'required',
                'jenis' => 'required'
            ]) ;

        $date = date('Y-m-d H:i:s') ;
        $ins = Order::create([
                'id_user' => $request->input('id_user'),
                'order_at' => $date,
                'revised_at' => $date,
                'id_packages' => $request->input('id_packages'),
                'id_jenis' => $request->input('jenis'),
                'title' => $request->input('title'),
                'brief' => $request->input('brief'),
                'price' => 0,
                'status' => 'SBMT'
            ]) ;

        if($ins->save()){
            foreach($request->input('sample') as $sample){
                DB::table('order_details')->insert(
                        ['id_order' => $ins->id, 'id_portfolio_sample' => $sample]
                    ) ;
            }
            return redirect('/home') ;
        }
        else
            return redirect('/order/'.$request->input('id_packages')) ;
    }

    public function detail($id){
        $data = Order::where('id_order', $id) ;
        if($data->count() == 1){
            $data = $data->join('order_status', 'orders.status', '=', 'order_status.id_status')                         
                         ->first() ;
            $order = DB::table('order_details')
                        ->join('portfolios', 'order_details.id_portfolio_sample', '=', 'portfolios.id_portfolios')
                        ->where('order_details.id_order', $id)
                        ->get() ;

            return view('detail', ['data' => $data, 'detail' => $order]) ;
        }else
            abort(404) ;
    }

    public function approveOrder($id){
        $data = Order::where([
                ['id_order', '=', $id],
                ['id_user', '=', Auth::user()->id],
                ['status', '=', 'CONF']
                ]) ;
        if($data->count() == 1){
            $upd = $data->update(['status' => 'APPR']) ;
            if($upd)
                return redirect('home') ;
            else
                abort(403) ;
        }
        else
            abort(404) ;
    }

    public function cancelOrder($id){
        $data = Order::where([
                ['id_order', '=', $id],
                ['id_user', '=', Auth::user()->id],
                ['status', '<>', 'CNCL']
                ]) ;
        if($data->count() == 1){
            $cncl = $data->update(['status' => 'CNCL']) ;
            if($cncl)
                return redirect('home') ;
            else
                abort(403) ;
        }
        else
            abort(404) ;
    }

    public function payOrder($id){
        $data = Order::where([
                ['id_order', '=', $id],
                ['id_user', '=', Auth::user()->id],
                ['status', '=', 'APPR']
                ]) ;
        if($data->count() == 1){
            // cek apakah sudah pernah payment 
            $pay = DB::table('payments')->where('id_order', '=', $id)->count() ;
            $data = $data->first() ;
            if($pay == 0){
                // boleh payment
                return view('payment', ['order' => $data]) ;
            }else
                abort(403) ;
        }
        else
            abort(404) ;
    }

    public function payPost(Request $request){
        $this->validate($request,[
            'id_order' => 'required|unique:payments',
            'pay' => 'required'
            ]) ;

        $ext = $request->pay->extension() ;
        if($ext == 'jpeg' || $ext == 'png'){
            $path = $request->pay->store('payments') ;
            $ins = DB::table('payments')->insert([
                'id_order' => $request->id_order,
                'picture' => $path,
                'status' => 'On process'
                ]);

            if($ins){
                // update status order to PAPR
                $upd = Order::where('id_order', $request->id_order)->update(['status' => 'PAPR']) ;
                return redirect('home') ;
            }else{
                return redirect('order/pay/'.$order->id_order) ;
            }

        }else{
            return redirect('order/pay/'.$request->id_order) ;
        }
    }

    /**
    *
    * Show invoice of order, different status return different invoice brief
    * @param $id
    * @return Response
    *
    */
    public function invoice($id){
        $data = Order::where('id_order', $id) ;
        if($data->count() == 1){
            $data = $data
                         ->join('users', 'orders.id_user', '=', 'users.id')
                         ->join('jenis_designs', 'orders.id_jenis', '=', 'jenis_designs.id_design')
                         ->first() ;
            return view('invoice', ['data' => $data]) ;
        }
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
        if(Auth::user()->id == $id){
            $data = User::find($id) ;
            return view('setting', ['user' => $data]) ;
        }
        else
            abort(404) ;
    }
    public function settings($id, $response){
        if(Auth::user()->id == $id){
            $data = User::find($id) ;
            return view('setting', ['user' => $data, 'response' => $response]) ;
        }
        else
            abort(404) ;
    }

    /**
    *
    * Store new data setting on user
    * @param Request $request
    * @param Response
    *
    */
    public function update(Request $request){
        $this->validate($request, [
                'name' => 'required|max:255',
                'username' => 'required|min:6|max:25',
                'email' => 'required|email|max:255',
                'gender' => 'required',
                'address' => 'required',
                'telp' => 'required|min:10|max:14',

            ]) ;
        $user = User::find($request->id) ;
        if(empty($request->password)){
            // bila password tidak diisi
            $user->username = $request->username ;
            $user->name = $request->name ;
            $user->email = $request->email ;
            $user->gender = $request->gender ;
            $user->telp = $request->telp ;
            $user->alamat = $request->address ;
        }else{
            $user->username = $request->username ;
            $user->name = $request->name ;
            $user->email = $request->email ;
            $user->password = bcrypt($request->password) ;
            $user->gender = $request->gender ;
            $user->telp = $request->telp ;
            $user->alamat = $request->address ;
        }

        if($user->save()){
            // data tersimpan sesuai harapan
            return redirect('setting/'.$request->id.'/success') ;
        }else{
            // data ngga tersimpan ada kendala
            return redirect('setting/'.$request->id.'/failed') ;
        }
    }

    /**
    *
    * Display the recent history of the user
    * @param $id user
    * @return Response history page
    *
    */
    public function recent($id){
        $data = User::find($id) ;
        if($data){
            $orders = DB::table('orders')
                        ->join('order_details', 'orders.id_order', '=', 'order_details.id_order')
                        ->join('portfolios', 'order_details.id_portfolio_sample', '=', 'portfolios.id_portfolios')
                        ->where('orders.id_user', $id)
                        // ->groupBy('orders.id_order')
                        ->get() ;
            return view('history', ['user' => $data, 'orders' => $orders]) ;
        }
        else
            abort(404) ;
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
            $testi = Testimonial::where('id_user', $id) ;
            if($testi->count() == 0){
                $testi->testimoni_desc = '' ;
                $testi->rating = '' ;
            }else{
                $testi = $testi->first() ;
            }
    		return view('profile', ['user' => $data, 'testi' => $testi]) ;
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
