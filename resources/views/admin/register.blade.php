@extends('layouts.dodolan')

@section('content')
<section id="page-title" class="pd-bt-20">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<form role="form" class="form-horizontal" method="POST" action="{{ url('/edit') }}">
					{{ csrf_field() }}

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="col-md-4 control-label">Name</label>

						<div class="col-md-6">
							<input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required autofocus>
							
							@if($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif

						</div>
					</div>

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

					<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
						<label for="username" class="col-md-4 control-label">Username</label>

						<div class="col-md-6">
							<input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" required>
							
							@if($errors->has('username'))
								<span class="help-block">
									<strong>{{ $errors->first('username') }}</strong>
								</span>
							@endif

						</div>
					</div>

					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="col-md-4 control-label">Password</label>

						<div class="col-md-6">
							<input type="password" name="password" id="password" class="form-control" required>
							
							@if($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif

						</div>
					</div>

					<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label for="gender" class="col-md-4 control-label">Gender</label>

                        <div class="col-md-6 pd-bt-5">
                            <input id="gender" type="radio" name="gender" required value="Laki laki"> Laki Laki
                            <input id="gender" type="radio" name="gender" required value="Perempuan"> Perempuan

                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('telp') ? ' has-error' : ''}}">
                        <label for="telp" class="col-md-4 control-label">Phone Number</label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">+62</span>
                                <input type="text" name="telp" id="telp" class="form-control" required value="{{ old('telp') }}">
                            </div>
                        </div>

                        @if ($errors->has('telp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telp') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">
                        <label for="roles" class="col-md-4 control-label">Roles</label>

                        <div class="col-md-6">
                            <select name="roles" class="form-control">
                            	@foreach ($roles as $role)
                            		<option value="{{$role->id_roles}}">{{$role->roles}}</option>
                            	@endforeach
                            </select>
                        </div>

                        @if ($errors->has('roles'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('roles') }}</strong>
                                </span>
                            @endif
                    </div>					


					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<input type="submit" name="submit" id="submit" value="Register" class="btn btn-success">
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>
@endsection