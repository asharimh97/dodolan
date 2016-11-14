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
				<tr><td colspan="4"><h4>&nbsp;</h4></td></tr>
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
				<tr><td colspan="4"><h4>&nbsp;</h4></td></tr>
				<tr>
					@foreach ($packages as $pack)
					<th>
						<p class="text-center">
							<?php 
								$min = explode('.', number_format($pack->min_price,0,",",".")) ;
								$max = explode('.', number_format($pack->max_price,0,",",".")) ;

								echo "IDR " ;
									echo '<span class="bigger">'.$min[0].'</span>.' ;
									echo '<span class="small">'.$min[1].'</span>' ;
								echo ' - ' ;

								if(count($max) == 2){
									echo '<span class="bigger">'.$max[0].'</span>.' ;
									echo '<span class="small">'.$max[1].'</span>' ;
								}else if(count($max) == 3){
									echo '<span class="bigger">'.$max[0].'.'.$max[1].'</span>' ;
									echo '<span class="small">'.$max[2].'</span>' ;
								}
								
							?>
							
						</p>
						</th>
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
