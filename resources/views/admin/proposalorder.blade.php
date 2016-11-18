@extends('layouts.dodolan2')
@section('title', 'Submit Proposal')
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
			<div class="col-md-6 pull-right">
				<form role="form" class="form" enctype="multipart/form-data" action="{{ url('admin/order/proposal/'.$order->id_order) }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{ $order->id_order }}">
					<div class="form-group{{ $errors->has('pic') ? ' has-error' : ''}}">
						<label class="control-label" for="pic">Picture</label>
						<input type="file" name="pic" id="pic" class="form-control" autofocus required>
						@if($errors->has('pic'))
							<span class="help-block">
								<strong>{{ $errors->first('pic') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
						<label class="control-label" for="desc">Description</label>
						<textarea name="desc" id="desc" class="form-control" rows="5" required>{{ old('desc') }}</textarea>

						@if($errors->has('desc'))
							<span class="help-block">
								<strong>{{ $errors->first('pic') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-success" value="Submit proposal">
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<form class="form">
					<div class="form-group">
						<label class="control-label">Order title</label>
						<input type="text" class="form-control" value="{{ $order->title }}" disabled>
					</div>
					<div class="form-group">
						<label class="control-label">Order brief</label>
						<textarea rows="5" class="form-control" disabled>{{ $order->brief }}</textarea>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection