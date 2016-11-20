@extends('layouts.blank')
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
		<div class="row pd-bt-40">
			<div class="col-md-12">
				<div class="col-md-12">
					<div class="col-md-2">
						<img src="{{ asset('assets/img/logo.png') }}" alt="Dodolan Design" title="Dodolan Design" class="invoice-head-img">
					</div>
					<div class="col-md-4 pull-right nowrap">
						<h3 class="mont-bold nowrap">Dodolan Design</h3>
						<p>Kaliurang Rd. KM 7.5, Condong Catur, Depok, Sleman<br>Yogyakarta, Indonesia</p>
						<p>
							<table class="table no-border">
								<tr>
									<td valign="top" class="col-md-1"><i class="fa fa-envelope"></i></td>
									<td>touch@dodolan.id</td>
								</tr>
								<tr>
									<td valign="top"><i class="fa fa-phone"></i></td>
									<td>+6281225443087</td>
								</tr>
							</table>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row pd-bt-30 invoice-bar">
			<div class="col-md-12">
				<h1 class="invoice-title">INVOICE</h1>
			</div>
		</div>
		<div class="row pd-bt-10">
			<div class="col-md-6">
				<p class="big"><strong>For : </strong>{{ $data->name }}</p>
				<p class="big"><strong>Date : </strong>{{ convertDate($data->order_at) }}</p>
			</div>
			<div class="col-md-5 col-md-offset-1">
				<p class="big"><strong>Invoice Number</strong></p>
				<p class="big">#{{ $data->id_order }}</p>
			</div>
		</div>
		<div class="row pd-bt-20">
			<div class="col-md-12">
				<table class="table no-border">
					<thead>
						<tr>
							<th class="col-md-1">No</th>
							<th class="col-md-4">Design ordered</th>
							<th>Type</th>
							<th>Price</th>
							<th class="col-md-3">Additional Info</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>
								<p class="big"><strong>{{ $data->title }}</strong></p>
								<p>{{ $data->brief }}</p>
							</td>
							<td>{{ $data->jenis_design }}</td>
							<td>
							<?php $nprice = $data->price/2 ; ?>
								@if($data->status == 'CNCL')
									Canceled order
								@elseif($data->price == '0')
									Unconfirmed Price, please wait
								@elseif($data->status == 'DONE' || $data->status == 'APRT' || $data->status == 'PRNT' || $data->status == 'DLVR')
									IDR {{ number_format($data->price, 2, ',', '.') }}
								@else
									IDR {{ number_format($nprice, 2, ',', '.') }}
								@endif
							</td>
							<td>
								@if($data->status == 'CONF' || $data->status == 'APPR' || $data->status == 'OWIP')
									Half payment to ensure you really order this design
								@elseif($data->status == 'DONE')
									Another half payment to fulfill the responsibility to pay, then will send the result through email
								@else
									Project payment
								@endif
							</td>
						</tr>
						@if($data->status == 'APRT' || $data->status == 'PRNT' || $data->status == 'DLVR')
						<tr>
							<td>2</td>
							<td>Print Order</td>
							<td>Printing</td>
							<td>Free</td>
							<td>No additional payment for shipping and printing order</td>
						</tr>
						@endif
						<tr>
							<td colspan="5"><div class="pd-bt-30">&nbsp;</div></td>
						</tr>
						<tfoot>
							<tr class="bigger">
								<td colspan="3" class="mont-bold">TOTAL : </td>
								<td colspan="2">
									@if ($data->status == 'CNCL')
										Canceled order
									@elseif($data->price == '0')
										Unconfirmed Price, please wait
									@elseif($data->status == 'DONE' || $data->status == 'APRT' || $data->status == 'PRNT' || $data->status == 'DLVR')
										IDR {{ number_format($data->price, 2, ',', '.') }}
									@else
										IDR {{ number_format($nprice, 2, ',', '.') }}
									@endif
								</td>
							</tr>
						</tfoot>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row pd-bt-10">
			<div class="col-md-12">
				<p>Please do your payment to :</p>
				<ul class="bank-list big">
					<li>BCA : 012314123123 on Behalf Dodolan Design</li>
					<li>BRI : 012314123123 on Behalf Dodolan Design</li>
					<li>BNI : 012314123123 on Behalf Dodolan Design</li>
					<li>Mandiri : 012314123123 on Behalf Dodolan Design</li>
				</ul>
				<br>
				<p>By paying the design you order you are agree to obey the term of service used in Dodolan Design, every cancellation won't make your money back. But we guarantee the best service to every user.</p>
			</div>
			<div class="col-md-4 col-md-offset-4 invoice-bar pd-bt-20 text-center">
				<h2 class="mont-bold nowrap">THANK YOU</h2>
			</div>
		</div>
	</div>
</section>
@endsection