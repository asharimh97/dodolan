@extends('layouts.dodolan2')
@section ('title', 'Revision')
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
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
							<img src="{{ asset('uploads/'.$props->picture) }}" class="head-img">
						</div>
					</div>
				@elseif($data->status == 'Proposed')
					<div class="row pd-bt-10">
						<p class="litbig">Order result : </p>
						<div class="col-md-3">
							<img src="{{ asset('uploads/'.$props->picture) }}" class="head-img">
						</div>
					</div>
				@elseif($data->status == 'Ask For Revision')
					<div class="row pd-bt-10">
						<p class="litbig">Order result : </p>
						<div class="col-md-3">
							<img src="{{ asset('uploads/'.$props->picture) }}" class="head-img">
						</div>
					</div>
				@elseif($data->status == 'Done')
					<div class="row pd-bt-10">
						<p class="litbig">Order result : </p>
						<div class="col-md-3">
							<img src="{{ asset('uploads/'.$props->picture) }}" class="head-img">
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
				<p>
					Price : 
					@if($data->status == 'Canceled')
						<span class="label label-danger">Canceled order</span>
					@elseif($data->price == '0')
						<span class="label label-danger">Unconfirmed price</span>
					@else
						IDR {{ number_format($data->price, 2, ',', '.') }}
					@endif
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<form class="form" role="form" action="{{ url('order/revs/'.$data->id_order) }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="id_order" value="{{ $data->id_order }}">
					<input type="hidden" name="id_prop" value="{{ $props->id }}">
					<div class="form-group{{ $errors->has('revs') ? ' has-error' : '' }}">
						<label class="control-label" for="revs">Revision brief</label>
						<textarea name="revs" id="revs" class="form-control" rows="5">{{ old('revs') }}</textarea>

						@if($errors->has('revs'))
							<span class="control-label">
								<strong>{{ $errors->first('revs') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Revise!" class="btn btn-warning mont">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection