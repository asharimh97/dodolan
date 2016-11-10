@extends('layouts.dodolan2')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form class="form" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/fileupload') }}">
				{{ csrf_field() }}

				<input type="hidden" name="userid" value="{{ Auth::user()->id }}">

				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<label for="title" class="control-label">Judul</label>
					<input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required autofocus>

					@if($errors->has('title'))
						<span class="help-block">
							<strong>{{ $errors->first('title') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
					<label for="desc" class="control-label">Description</label>
					<textarea name="desc" id="desc" class="form-control">{{ old('desc') }}</textarea>

					@if($errors->has('desc'))
						<span class="help-block">
							<strong> {{ $errors->first('desc') }} </strong>
						</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
					<label for="rating" class="control-label">Rating</label>
					<!-- <div class="col-md-8"> -->
						<select name="rating" id="rating" class="form-control">
							<?php for($i=1; $i<= 5; $i++){?>
								<option value="{{ $i }}">{{ $i }}</option>
							<?php } ?>
						</select>
					<!-- </div> -->

					@if($errors->has('rating'))
						<span class="help-block">
							<strong>{{ $errors->first('rating') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
					<label for="jenis" class="control-label">Jenis Design</label>
					<select name="jenis" id="jenis" class="form-control">
						@foreach ($jenis as $jenis)
							<option value="{{ $jenis->id_design }}">{{ $jenis->jenis_design }}</option>
						@endforeach
					</select>

					@if($errors->has('jenis'))
						<span class="help-block">
							<strong>{{ $errors->first('jenis') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
					<label for="foto" class="control-label">Upload foto</label>
					<input type="file" name="foto" id="foto" class="form-control">

					@if($errors->has('foto'))
						<span class="help-block">
							<strong>{{ $errors->first('foto') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group">
					<input type="submit" name="submit" value="Submit" class="btn btn-success">
				</div>

			</form>
		</div>
	</div>
</div>

@endsection