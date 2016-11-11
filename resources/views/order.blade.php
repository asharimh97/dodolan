@extends('layouts.dodolan2')
@section('title', 'Pricing and Order')
@section('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
			<table class="table no-border text-center">
				<thead>
					<tr>
						@foreach ($packages as $pack)
						<th class="col-md-3"><h2 class="mont text-center">{{ $pack->packages }}</h2></th>
						@endforeach
					</tr>
				</thead>
				<tr>
					@foreach ($packages as $pack)
					<?php 
						$list = explode(',', $pack->description) ;
					?>
					<td>
						<ul class="packages-feature">
							
							@for ($i = 0; $i< count($list) ; $i++)
							<li class="list-feature litbig">{{ $list[$i] }}</li>
							@endfor

						</ul>
					</td>
					@endforeach
				</tr>
				<tr>
					@foreach ($packages as $pack)
					<th><p class="text-center">IDR {{ number_format($pack->min_price,0,",",".").' - '.number_format($pack->max_price,0,",",".") }}</p></th>
					@endforeach
				</tr>
				<tfoot>
					<tr>
						@foreach ($packages as $pack)
						<td><a href="{{ url('order/'.$pack->id_packages) }}" class="btn btn-info">Order now!</a></td>
						@endforeach
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>
@endsection
