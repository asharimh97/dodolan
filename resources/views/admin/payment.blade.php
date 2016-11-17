@extends('layouts.admin')
@section('title', 'Payments')
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
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-hover no-border">
					<thead>
						<tr>
							<th>No</th>
							<th>Order</th>
							<th>User name</th>
							<th>Order date</th>
							<th class="col-md-2">Transfer proof</th>
							<th class="col-md-2">Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0 ;?>
						@foreach ($payments as $pay)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $pay->title }}</td>
							<td>{{ $pay->name }}</td>
							<td>{{ convertDate($pay->order_at) }}</td>
							<td>
								<img src="{{ asset('uploads/'.$pay->picture) }}" class="head-img">
							</td>
							<td>
								@if($pay->payment_status == 'On process')
									<span class="label label-info">On payment process</span>
								@elseif($pay->payment_status == 'Confirmed')
									<span class="label label-success">Confirmed</span>
								@endif
							</td>
							<td>
								<a href="{{ url('admin/payment/reject/'.$pay->id_order) }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
								<a href="{{ url('admin/payment/approve/'.$pay->id_order) }}" class="btn btn-success"><i class="fa fa-check"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection