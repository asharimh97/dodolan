@extends('layouts.dodolan2')
@section('title', $order->title.' Payment')
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form role="form" method="POST" action="{{ url('order/payment') }}" enctype="multipart/form-data" class="form-horizontal">
					{{ csrf_field() }}
					<input type="hidden" name="id_order" value="{{ $order->id_order }}">
					<div class="form-group">
						<label for="title" class="control-label col-md-2">Order</label>
						<div class="col-md-6">
							<input type="text" name="title" id="title" value="{{ $order->title }}" class="form-control" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="desc" class="control-label col-md-2">Brief</label>
						<div class="col-md-6">
							<textarea name="desc" id="desc" class="form-control" rows="7" disabled>{{ $order->brief }}</textarea>
						</div>
					</div>
					<div class="form-group{{ $errors->has('pay') ? ' has-error' : ''}}">
						<label for="pay" class="control-label col-md-2">Transfer Proof</label>
						<div class="col-md-6">
							<input type="file" name="pay" id="pay" class="form-control">

							@if($errors->has('pay'))
								<span class="help-block">
									<strong>{{ $errors->first('pay') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3 col-md-offset-2">
							<input type="submit" name="submit" value="Confirm payment" class="btn btn-success mont">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection