@extends('layouts.dodolan2')
@section ('title', 'Print Project')
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>{{ $data->title }}</h3>
				<p>{{ $data->brief }}</p>
				<p>Sample : </p>
				<div class="row">
					@foreach ($detail as $detail)
					<div class="col-md-3 mg-bt-10">
						<img src="{{ asset('uploads/'.$detail->picture) }}" class="head-img">
					</div>
					@endforeach
				</div>
				@if($data->status == 'Work In Progress')
					<div class="row pd-bt-10">
						<p class="litbig">Order result : </p>
						<div class="col-md-3">
							<img src="{{ asset('uploads/'.$prop->picture) }}" class="head-img">
						</div>
					</div>
				@elseif($data->status == 'Proposed')
					<div class="row pd-bt-10">
						<p class="litbig">Order result : </p>
						<div class="col-md-3">
							<img src="{{ asset('uploads/'.$prop->picture) }}" class="head-img">
						</div>
					</div>
				@elseif($data->status == 'Ask For Revision')
					<div class="row pd-bt-10">
						<p class="litbig">Order result : </p>
						<div class="col-md-3">
							<img src="{{ asset('uploads/'.$prop->picture) }}" class="head-img">
						</div>
					</div>
				@elseif($data->status == 'Done')
					<div class="row pd-bt-10">
						<p class="litbig">Order result : </p>
						<div class="col-md-3">
							<img src="{{ asset('uploads/'.$prop->picture) }}" class="head-img">
						</div>
					</div>
				@endif
				<p>
					Status order : 
					@if($data->status == 'Submitted')
                        <span class="label label-default">{{ $data->status }}</span>
                    @elseif($data->status == 'Canceled')
                        <span class="label label-danger">{{ $data->status }}</span>
                    @elseif($data->status == 'On Working Process' || $data->status == 'Work In Progress')
                        <span class="label label-warning">{{ $data->status }}</span>
                    @elseif($data->status == 'Approved' || $data->status == 'Confirmed')
                        <span class="label label-info">{{ $data->status }}</span>
                    @elseif($data->status == 'Paid')
                        <span class="label label-primary">{{ $data->status }}</span>
                    @else
                        <span class="label label-success">{{ $data->status }}</span>
                    @endif
				</p>
				
				<div class="row">
					<div class="col-md-6">
						<form action="{{ url('order/print/') }}" method="POST" class="form">
							{{ csrf_field() }}
							<input type="hidden" name="id_order" value="{{ $data->id_order }}">

							<div class="form-group{{ $errors->has('brief') ? ' has-error' : '' }}">
								<label class="control-label" for="brief">Print Brief</label>
								<textarea class="form-control" name="brief" id="brief" rows="5" required autofocus>
									{{ old('brief') }}
								</textarea>

								@if($errors->has('brief'))
									<span class="help-block">
										<strong>{{ $errors->first('brief') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="Submit request" class="btn btn-success mont">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection