@extends('layouts.dodolan2')
@section('title', 'Order Detail')
@section('content')
<?php 
    function convertDate($date){
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
?>
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
			<div class="col-md-12">
				<h2 class="mont">{{ $order->title }}</h2>
				<div class="row">
					<div class="col-md-3">
						<p>
							<strong>Order by : </strong> {{ $order->name }}
							<br>
							<strong>Order at : </strong> {{ convertDate($order->order_at) }}
							<br>
						</p>
					</div>
					<div class="col-md-3">
						<p>
							<strong>Price offered : </strong> IDR {{ number_format($order->price, 2, ',', '.') }}
							<br>
							<strong>Order status : </strong> <span class="label label-success">{{ $order->status }}</span>
						</p>
					</div>
				</div>
				<p>{{ $order->brief }}</p>
				<p>Sample chosen by user : </p>
				<div class="row pd-bt-10">
					@foreach ($samples as $sample)
					<div class="col-md-2"><img src="{{ asset('uploads/'.$sample->picture) }}" class="head-img" alt="{{ $sample->title }}" title="{{ $sample->title }}"></div>
					@endforeach
				</div>
				<p>Our team design proposals : </p>
				<div class="row pd-bt-10">
					@foreach ($props as $prop)
					<div class="col-md-2"><img src="{{ asset('uploads/'.$prop->picture) }}" class="head-img" alt="{{ $prop->title }}" title="{{ $prop->title }}"></div>
					@endforeach
				</div>
				<p>
					<a href="{{ url('order/invoice/'.$order->id_order) }}" class="btn btn-default" target="_blank"><i class="fa fa-paperclip"></i></a> View invoice 
					@if($order->status == 'CONF' || $order->status == 'APPR' || $order->status == 'RVSD' || $order->status == 'APRT')
					<a href="{{ url('admin/order/approve/'.$order->id_order) }}" class="btn btn-success"><i class="fa fa-check"></i></a> Approve request
					@endif
					@if($order->status == 'PRNT')
					<a href="{{ url('admin/order/approve/'.$order->id_order) }}" class="btn btn-success" target="_blank"><i class="fa fa-check"></i></a> Confirm and Deliver Print
					@endif
					@if($order->status == 'OWIP')
					<a href="{{ url('admin/order/proposal/'.$order->id_order) }}" class="btn btn-success" target="_blank"><i class="fa fa-upload"></i></a> Submit design proposal
					@endif

				</p>
			</div>
		</div>
	</div>
</section>
@endsection