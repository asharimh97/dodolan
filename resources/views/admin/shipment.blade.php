@extends('layouts.dodolan2')
@section('title', 'Deliver Print')
@section ('content')
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
			<div class="row pd-bt-10">
				<div class="col-md-6">
					<form role="form" action="{{ url('admin/order/deliver') }}" method="POST" class="form">
						{{ csrf_field() }}
						<input type="hidden" name="id_order" value="{{ $order->id_order }}">
						<div class="form-group{{ $errors->has('resi') ? ' has-error' : '' }}">
							<label class="control-label" for="resi">Package Number</label>
							<input type="text" name="resi" id="resi" class="form-control" required autofocus>

							@if($errors->has('resi'))
								<span class="help-block">
									<strong>{{ $errors->first('resi') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="submit" class="btn btn-success">
						</div>
					</form>
				</div>
			</div>
	</div>
</section>
@endsection