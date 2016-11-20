<?php

namespace App\Http\Controllers;

use App\User ;
use App\Testimonial ;
use App\Portfolio ;
use App\Order ;
use App\Proposal ;

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

            $props = Proposal::where('id_order', $id)->get() ;

            return view('detail', ['data' => $data, 'detail' => $order, 'props' => $props]) ;
        }else
            abort(404) ;
    }

    public function approveOrder($id){
        $data = Order::where([
                ['id_order', '=', $id],
                ['id_user', '=', Auth::user()->id],
                // ['status', '=', 'CONF']
                ]) ;
        if($data->count() == 1){
            $ord = $data->first() ;
            if($ord->status == 'CONF'){

                $upd = $data->update(['status' => 'APPR']) ;
                if($upd)
                    return redirect('home') ;
                else
                    abort(403) ;

            }else if($ord->status == 'PROP'){
                // if status was prop, set to done, get last proposal item, store to portfolios
                $upd = $data->update(['status' => 'DONE']) ;
                $prop = Proposal::where('id_order', $id) ;
                $prop_last = $prop->orderBy('id', 'desc')->first() ;
                $props = Proposal::where('id', $prop_last->id)->update(['status' => 'Approved']) ;
                $portfolio = Portfolio::create([
                            'title' => $ord->title,
                            'description' => $prop_last->description,
                            'id_user' => $ord->id_user,
                            'rating' => '5',
                            'id_jenis_design' => $ord->id_jenis,
                            'picture' => $prop_last->picture
                    ]) ;

                if($portfolio)
                    return redirect('order/detail/'.$id) ;
                else
                    abort(503) ;
            }
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

    public function revsOrder($id){
        $data = Order::where([
                    ['id_order', $id],
                    ['orders.status', 'PROP']
                    ]) ;
        if($data->count() == 1){
            $data = $data->join('order_status', 'orders.status', '=', 'order_status.id_status')                         
                         ->first() ;
            $order = DB::table('order_details')
                        ->join('portfolios', 'order_details.id_portfolio_sample', '=', 'portfolios.id_portfolios')
                        ->where('order_details.id_order', $id)
                        ->get() ;

            $props = Proposal::where('id_order', $id)->orderBy('id', 'desc')->first() ;

            return view('revision', ['data' => $data, 'detail' => $order, 'props' => $props]) ;
        }else
            abort(404) ;
    }

    public function postRevsOrder(Request $request){
        $this->validate($request,[
                'revs' => 'required'
            ]) ;
        $date = date('Y-m-d H:i:s') ;
        $prop = Proposal::find($request->id_prop) ;
        if($prop){

            $ins = DB::table('order_revisions')->insert([
                        'id_order' => $request->id_order, 'id_proposal' => $request->id_prop, 'revision' => $request->revs, 'revision_date' => $date
                ]) ;
            if($ins){
                $props = Proposal::where('id', $prop->id)->update(['status' => 'Revised']) ;
                $order = Order::where('id_order', $prop->id_order)->update(['status' => 'RVSD']) ;

                return redirect('home') ;
            }

        }else{
            abort(404) ;
        }

    }

    public function payOrder($id){
        $data = Order::where([
                ['id_order', '=', $id],
                ['id_user', '=', Auth::user()->id],
                ['status', '=', 'APPR']
                ])
                ->orWhere([
                ['id_order', '=', $id],
                ['id_user', '=', Auth::user()->id],
                ['status', '=', 'PYRJ']]) ;
        if($data->count() == 1){
            // cek apakah sudah pernah payment 
            $pay = DB::table('payments')->where([
                        ['id_order', '=', $id],
                        ['payment_status', '=', 'On process']
                        ])->count() ;
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
            'id_order' => 'required',
            'pay' => 'required'
            ]) ;

        $ext = $request->pay->extension() ;
        $date = date('Y-m-d H:i:s') ;
        if($ext == 'jpeg' || $ext == 'png'){
            $path = $request->pay->store('payments') ;
            $ins = DB::table('payments')->insert([
                'id_order' => $request->id_order,
                'picture' => $path,
                'payment_status' => 'On process',
                'payment_date' => $date
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

    public function requestPrint($id){
        $data = Order::where([
                ['id_order', $id],
                ['orders.status', 'DONE']
                ]) ;
        if($data->count() == 1){
            $data = $data->join('order_status', 'orders.status', '=', 'order_status.id_status')                         
                         ->first() ;
            $order = DB::table('order_details')
                        ->join('portfolios', 'order_details.id_portfolio_sample', '=', 'portfolios.id_portfolios')
                        ->where('order_details.id_order', $id)
                        ->get() ;

            $prop = Proposal::where('id_order', $id)->orderBy('id', 'desc')->first() ;

            return view('print', ['data' => $data, 'detail' => $order, 'prop' => $prop]) ;
        }
        else
            abort(404) ;
    }

    public function postPrint(Request $request){
        $this->validate($request,[
                'brief' => 'required'
            ]) ;
        $order = Order::where('id_order', $request->id_order) ;
        if($order->count() == 1){
            $print = DB::table('order_prints')->where('id_order', $request->id_order) ;
            if($print->count() == 0){

                $date = date('Y-m-d H:i:s') ;
                $ins = DB::table('order_prints')->insert([
                        'id_order' => $request->id_order, 'brief' => $request->brief, 'print_at' => $date, 'resi' => '', 'status' => 'Waiting'
                    ]) ;

                if($ins){
                    // change status to request for print, invoice will add detail for print
                    $upd = $order->update(['status' => 'APRT']) ;
                    return redirect('home') ;
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

    public function testi(){
        $tes = Testimonial::where('id_user', Auth::user()->id) ;
        if($tes->count() == 0){
            return view('testimoni') ;
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

        if($ins)
            return redirect('profile/'.$userid) ;
        else
            abort(503) ;
        
    }

}
