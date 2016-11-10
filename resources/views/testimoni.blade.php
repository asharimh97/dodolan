@extends ('layouts.dodolan2')

@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form role="form" action="{{ url('/testimoni') }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					<input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
					<input type="hidden" name="unique_code" value="{{ uniqid() }}">

					<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
						<label class="control-label col-md-4" for="desc">Testimonial</label>
						<div class="col-md-6">
							<textarea name="desc" id="desc" class="form-control"  autofocus>{{ old('desc') }}</textarea>

							@if($errors->has('desc'))
								<span class="help-block">
									<strong>{{ $errors->first('desc') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
						<label class="control-label col-md-4" for="rating">Rating</label>
						<div class="col-md-2">
							<select name="rating" id="rating" class="form-control">
								@for ($i=1; $i<=5; $i++)
									<option value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-4 col-md-offset-4">
							<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>
@endsection