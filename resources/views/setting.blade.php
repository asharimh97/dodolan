@extends ('layouts.dodolan2')
@section ('title', 'Setting')
@section ('content')
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
						<li><a href="{{ url('profile/'.$user->id) }}"><i class="fa fa-user"></i> Profile</a></li>
						@if(Auth::user()->id == $user->id)
						<li class="active"><a href="{{ url('setting/'.$user->id) }}"><i class="fa fa-gears"></i> Setting</a></li>
						@endif
						<li><a href="{{ url('recent/'.$user->id) }}"><i class="fa fa-calendar"></i> Recent Activity</a></li>
					</ul>
				</div>
			</aside>
			<!-- /Profile sidebar -->
			<!-- Setting content -->
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-10">
						<p class="bigger">{{ $user->name }}'s setting</p>
						<?php 
							if(isset($response)){
								if($response == "success"){
									echo '<div class="alert alert-success">
											   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											  <strong>Success!</strong> Your data has been updated
										  </div>' ;
								}else{
									echo '<div class="alert alert-danger">
											   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											  <strong>Failed!</strong> We found some error, try again later
										  </div>' ;
								}
							}
						?>
						<form class="form-horizontal" role="form" action="{{ url('/update') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{ Auth::user()->id }}">
						<input type="hidden" name="username" value="{{ $user->username }}">
							<div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
								<label for="user" class="control-label col-md-2">Username</label>
								<div class="col-md-8">
									<input type="text" name="user" id="user" class="form-control" value="{{ $user->username }}" disabled>

									@if($errors->has('user'))
										<span class="help-block">
											<strong>{{ $errors->first('user') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="control-label col-md-2">Email</label>
								<div class="col-md-8">
									<input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required autofocus>

									@if($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="control-label col-md-2">Name</label>
								<div class="col-md-8">
									<input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>

									@if($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="control-label col-md-2">Password</label>
								<div class="col-md-8">
									<input type="password" name="password" id="password" class="form-control" placeholder="Password">

									@if($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
								<label for="gender" class="control-label col-md-2">Gender</label>
								<div class="col-md-8">
									@if($user->gender == "Laki laki")
									<input id="gender" type="radio" name="gender" value="Laki laki" checked required> Laki laki
									<input id="gender" type="radio" name="gender" value="Laki laki" required> Perempuan
									@else
									<input id="gender" type="radio" name="gender" value="Laki laki" required> Laki laki
									<input id="gender" type="radio" name="gender" value="Laki laki" checked required> Perempuan
									@endif

									@if($errors->has('gender'))
										<span class="help-block">
											<strong>{{ $errors->first('gender') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('telp') ? ' has-error' : ''}}">
	                            <label for="" class="col-md-2 control-label">Phone</label>

	                            <div class="col-md-8">
	                                <div class="input-group">
	                                    <span class="input-group-addon">+62</span>
	                                    <input type="text" name="telp" id="telp" class="form-control" required value="{{ $user->telp }}">
	                                </div>
	                            </div>

	                            @if ($errors->has('telp'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('telp') }}</strong>
	                                    </span>
	                                @endif
	                        </div>
	                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
	                            <label for="address" class="col-md-2 control-label">Address</label>

	                            <div class="col-md-8">
	                                <textarea name="address" id="address" class="form-control" required>{{ $user->alamat }}</textarea>
	                            </div>

	                            @if ($errors->has('address'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('address') }}</strong>
	                                    </span>
	                                @endif
	                        </div>

							<div class="form-group">
								<div class="col-md-offset-2 col-md-6">
									<input type="submit" name="submit" value="Update data!" class="btn btn-success">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /Setting content -->
		</div>
	</div>
</section>
@endsection