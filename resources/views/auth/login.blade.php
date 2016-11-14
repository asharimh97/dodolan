@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pd-bt-30">
        <form class="form-signin" role="form" action="{{ url('login/') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-signin-heading" style="text-align:center;">
            <img src="{{asset('assets/img/logo.png')}}" class="logo-small">
            </div>
            <br>
            <h4 class="form-signin-heading text-center">Dodolan Login</h4>
            <div class="error-box" style="color : red ;">
                @if($errors->has('email'))
                    <p>{{ $errors->first('email') }}</p>
                @endif

                @if($errors->has('password'))
                    <p>{{ $errors->first('password') }}</p>
                @endif

            </div>
            <label for="email" class="sr-only">Username</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required="required" autofocus/>
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required">

            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-success btn-block btn-login" type="submit">LOG IN</button>
        <p class="text-center"><a href="{{ url('/password/reset') }}">Forgot password?</a> or don't have account? <a href="{{ url('/register') }}">Register!</a></p>
    </form>
       <!--  <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection
