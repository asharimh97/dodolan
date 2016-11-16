@extends('layouts.dodolan2')
@section('title', 'Contact Us')
@section('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
			<div class="col-md-12">
				<div class="col-md-6">
					@if (Auth::guest())
						<img src="{{ asset('assets/img/question-2.png') }}" alt="Getting confused?" title="Getting confused?" class="head-img">
					@else
						@if (Auth::user()->gender == "Perempuan")
						<img src="{{ asset('assets/img/question-1.png') }}" alt="Getting confused?" title="Getting confused?" class="head-img">
						@else
						<img src="{{ asset('assets/img/question-2.png') }}" alt="Getting confused?" title="Getting confused?" class="head-img">
						@endif
					@endif
				</div>
				<div class="col-md-6">
					<form role="form" method="POST" action="{{ url('feedback') }}" class="form">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							<label for="title" class="control-label">Title</label>
							<input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') }}" class="form-control" required autofocus>
							@if($errors->has('title'))
								<span class="help-block">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="control-label">Name</label>
							@if(Auth::guest())
							<input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}" class="form-control disabled" required autofocus>
							@else
							<input type="text" name="name2" id="name" placeholder="Name" value="{{ Auth::user()->name }}" class="form-control" disabled>
							<input type="hidden" name="name" value="{{ Auth::user()->name }}">
							@endif

							@if($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="control-label">Email address</label>
							@if(Auth::guest())
							<input type="email" name="email" id="email" placeholder="Email address" value="{{ old('email') }}" class="form-control">
							@else
							<input type="email" name="email2" id="email" placeholder="Email address" value="{{ Auth::user()->email }}" class="form-control" disabled>
							<input type="hidden" name="email" value="{{ Auth::user()->email }}">
							@endif
							@if($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group{{ $errors->has('feedback') ? ' has-error' : '' }}">
							<label for="feedback" class="control-label">Your opinion</label>
							<textarea id="feedback" name="feedback" class="form-control" rows="10">{{ old('feedback') }}</textarea>
							@if($errors->has('feedback'))
								<span class="help-block">
									<strong>{{ $errors->first('feedback') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="Give feedback" class="btn btn-success">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
