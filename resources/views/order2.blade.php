@extends('layouts.dodolan2')
@section('title', 'Order')
@section('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
			<div class="col-md-10">
				<form action="{{ url('orderpost') }}" method="POST" role="form" class="form-horizontal">
					{{ csrf_field() }}
					<input type="hidden" name="id_packages" value="{{ $id }}">
					<input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
					<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
						<label for="title" class="control-label col-md-2">Title</label>
						<div class="col-md-8">
							<input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" autofocus>

							@if($errors->has('title'))
								<span class="help-block">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('brief') ? ' has-error' : '' }}">
						<label for="brief" class="control-label col-md-2">Design Brief</label>
						<div class="col-md-8">
							<textarea name="brief" id="brief" class="form-control" rows="7">{{ old('brief') }}</textarea>

							<span class="help-block">
								<p class="small">The more detail is better</p>
							@if ($errors->has('brief'))
									<p><strong>{{ $errors->first('brief') }}</strong></p>
							@endif
							</span>
						</div>
					</div>
					<div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
						<label for="jenis" class="control-label col-md-2">Type</label>
						<div class="col-md-4">
							<select name="jenis" id="jenis" class="form-control">
								<option></option>
								@foreach ($jenis as $jenis)
								<option value="{{ $jenis->id_design }}">{{ $jenis->jenis_design }}</option>
								@endforeach
							</select>

							@if ($errors->has('jenis'))
								<span class="help-block">
									<strong>{{ $errors->first('jenis') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('sample') ? ' has-error' : '' }}">
						<label for="sample" class="control-label col-md-2">Choose sample</label>
						<div class="col-md-8">
							@foreach ($samples as $sample)
								<label class="col-md-3">
									<img src="{{ asset('uploads/'.$sample->picture) }}" class="head-img sample-label">
									<input type="checkbox" id="sample" name="sample[]" value="{{ $sample->id_portfolios }}" class="sample hidden">
								</label>
							@endforeach
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8 col-md-offset-2">
							<input type="submit" name="submit" value="Order!" class="btn btn-success">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection