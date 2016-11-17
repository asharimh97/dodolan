@extends('layouts.admin')
@section('title', 'Orders')
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
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
                            <th class="col-md-2">Order</th>
                            <th class="col-md-4">Brief order</th>
                            <th class="col-md-2">Order date</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1 ;?>
						@foreach ($orders as $user)
						<tr>
							<td>{{ $i }}</td>
                            <td>{{ $user->title }}</td>
                            <td>{{ $user->brief }}</td>
                            <td>{{ convertDate($user->order_at) }}</td>
                            <td>
                                @if($user->price == 0)
                                    <span class="label label-danger">Price unconfirmed</span>
                                @else
                                    {{ number_format($user->price, 2, ',', '.') }}
                                @endif

                            </td>
                            <td>
                                @if($user->status == 'Submitted')
                                    <span class="label label-default">{{ $user->status }}</span>
                                @elseif($user->status == 'Canceled')
                                    <span class="label label-danger">{{ $user->status }}</span>
                                @elseif($user->status == 'On Working Process' || $user->status == 'Work In Progress')
                                    <span class="label label-warning">{{ $user->status }}</span>
                                @elseif($user->status == 'Approved' || $user->status == 'Confirmed')
                                    <span class="label label-info">{{ $user->status }}</span>
                                @elseif($user->status == 'Paid')
                                    <span class="label label-primary">{{ $user->status }}</span>
                                @else
                                    <span class="label label-success">{{ $user->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('order/detail/'.$user->id_order) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                                @if($user->status == 'SBMT')
                                <a href="{{ url('admin/order/reject/'.$user->id_order) }}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                <a href="{{ url('admin/order/approve/'.$user->id_order) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                @endif
                                <a href="{{ url('admin/order/delete/'.$user->id_order) }}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
						</tr>
						<?php $i++ ; ?>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection