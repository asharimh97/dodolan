@extends('layouts.dodolan2')
@section('title', $user->name)
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
		<div class="row pd-bt-30">
			<!-- Prodile sidebar -->
			<aside class="col-md-3">
				<div class="profile-frame">
					<div class="col-md-12">
						<div class="row pd-bt-30">
							<div class="col-md-8 col-md-offset-2">
								<img src="{{ asset('assets/'.$user->prof_pic) }}" title="{{ $user->name }}" alt="{{ $user->name }}" class="profile-picture">
							</div>
						</div>
							<p class="big nowrap">{{ $user->name }}</p>
							<p>{{ $user->email }}</p>
					</div>
				</div>
				<div class="profile-link">
					<ul class="profile-detail">
						<li class="active"><a href="{{ url('profile/'.$user->id) }}"><i class="fa fa-user"></i> Profile</a></li>
						@if(Auth::user()->id == $user->id)
						<li><a href="{{ url('setting/'.$user->id) }}"><i class="fa fa-gears"></i> Setting</a></li>
						@endif
						<li><a href="{{ url('recent/'.$user->id) }}"><i class="fa fa-calendar"></i> Recent Activity</a></li>
					</ul>
				</div>
			</aside>
			<!-- /Profile sidebar -->
			<!-- Profile content -->
			<div class="col-md-9">
				<div class="profile-bio-frame">
					<div class="row pd-bt-15">
						<div class="col-md-10 col-md-offset-1">
							<p class="big nowrap">
								@for($i=0; $i<$testi->rating; $i++)
									<i class="fa fa-star"></i>
								@endfor
							</p>
							<p class="litbig">
								@if($testi->testimoni_desc == "")
									No testimonial found
								@else
								"{{ $testi->testimoni_desc }}"
								@endif
							</p>
						</div>
					</div>
				</div>
				<div class="profile-content-frame">
					<div class="row pd-20">
						<div class="col-md-12">
							<p class="bigger">Bio Graph</p>
							<div class="col-md-6">
								<table class="table no-border">
									<tr>
										<td>Name</td>
										<td> : </td>
										<td> {{ $user->name }} </td>
									</tr>
									<tr>
										<td>Email </td>
										<td> : </td>
										<td> {{ $user->email }} </td>
									</tr>
									<tr>
										<td>Phone number </td>
										<td> : </td>
										<td> +62{{ $user->telp }} </td>
									</tr>
									<tr>
										<td>Registered at </td>
										<td> : </td>
										<td> {{ convertDate($user->created_at) }} </td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table class="table no-border">
									<tr>
										<td>Username</td>
										<td> : </td>
										<td class="col-md-8"> {{ $user->username }} </td>
									</tr>
									<tr>
										<td>Gender </td>
										<td> : </td>
										<td> {{ $user->gender }} </td>
									</tr>
									<tr>
										<td>Address </td>
										<td> : </td>
										<td> {{ $user->alamat }} </td>
									</tr>
									<tr>
										<td>Last change at </td>
										<td> : </td>
										<td> {{ convertDate($user->created_at) }} </td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Profile content -->
		</div>
	</div>
</section>
@endsection