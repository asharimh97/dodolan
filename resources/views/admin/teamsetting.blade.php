@extends('layouts.dodolan2')
@section('title', $team->name)
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
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
						<li><a href="{{ url('admin/team/view/'.$team->id_team) }}"><i class="fa fa-team"></i> Profile</a></li>
						<li class="active"><a href="{{ url('admin/team/edit/'.$team->id_team) }}"><i class="fa fa-gears"></i> Edit data</a></li>
					</ul>
				</div>
			</aside>

			<div class="col-md-9">
				<!-- Setting content -->
				<div class="col-md-12">
					<form role="form" class="form-horizontal" action="" method="POST">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-2 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" name="name" id="name" value="{{ $team->name }}" class="form-control" autofocus required>

								@if($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3 col-md-offset-2">
								<input type="submit" name="submit" value="Edit" class="btn btn-success">
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</section>
@endsection