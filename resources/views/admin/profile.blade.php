@extends('layouts.dodolan2')
@section('title', $team->name)
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
								<img src="{{ asset('uploads/'.$team->prof_pic) }}" title="{{ $team->name }}" alt="{{ $team->name }}" class="profile-picture">
							</div>
						</div>
							<p class="big nowrap">{{ $team->name }}</p>
							<p>
								<?php 
									$d = explode(" ", $team->name) ;
									echo strtolower($d[0]).'@dodolan.id' ;
								?>
							</p>
							<p>
								<ul class="social-team-links">
                                    <li><a href="{{ $team->youtube }}" data-toggle="tooltip" data-placement="top" title="Youtube" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                                    <li><a href="{{ $team->facebook }}" data-toggle="tooltip" data-placement="top" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{ $team->twitter }}" data-toggle="tooltip" data-placement="top" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{ $team->instagram }}" data-toggle="tooltip" data-placement="top" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="{{ $team->google }}" data-toggle="tooltip" data-placement="top" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
							</p>
					</div>
				</div>
				<div class="profile-link">
					<ul class="profile-detail">
						<li class="active"><a href="{{ url('admin/team/view/'.$team->id_team) }}"><i class="fa fa-team"></i> Profile</a></li>
						<li><a href="{{ url('admin/team/edit/'.$team->id_team) }}"><i class="fa fa-gears"></i> Edit data</a></li>
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
								@for($i=0; $i<5; $i++)
									<i class="fa fa-star"></i>
								@endfor
							</p>
							<p class="litbig">
								{{$team->bio}}
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
										<td>{{$team->name}}</td>
									</tr>
									<tr>
										<td>Email </td>
										<td> : </td>
										<td>
											<?php 
												$d = explode(" ", $team->name) ;
												echo strtolower($d[0]).'@dodolan.id' ;
											?>
										</td>
									</tr>
									<tr>
										<td>Phone number </td>
										<td> : </td>
										<td> +6281230123123 </td>
									</tr>
									<tr>
										<td>Registered at </td>
										<td> : </td>
										<td>13 November 2016</td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table class="table no-border">
									<tr>
										<td>Username</td>
										<td> : </td>
										<td class="col-md-8">{{strtolower($d[0].$d[1])}}</td>
									</tr>
									<tr>
										<td>Gender </td>
										<td> : </td>
										<td>Male</td>
									</tr>
									<tr>
										<td>Address </td>
										<td> : </td>
										<td>
											Jalan Kaliurang KM 7.5, Condong Catur, Depok, Sleman
										</td>
									</tr>
									<tr>
										<td>Last change at </td>
										<td> : </td>
										<td>14 November 2016</td>
									</tr>
								</table>
							</div>

							<a href="{{ url('admin/teams') }}" class="btn btn-success">Back to teams</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /Profile content -->
		</div>
	</div>
</section>
@endsection