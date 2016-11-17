@extends('layouts.dodolan2')
@section('title', '')
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-1">
				<form role="form" method="POST" action="{{ url('admin/order/approve/'.$order->id_order) }}">
					{{ csrf_field() }}
					<input type="hidden" name="id_order" value="{{ $order->id_order }}">
					<input type="hidden" name="min_price" value="{{ $order->min_price }}">
					<input type="hidden" name="max_price" value="{{ $order->max_price }}">
					<div class="form-group">
						<label for="title" class="control-label">Title</label>
						<input type="text" name="title" id="title" value="{{ $order->title }}" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label class="control-label" for="brief">Order brief</label>
						<textarea name="brief" id="brief" class="form-control" rows="7" disabled>{{ $order->brief }}</textarea>
					</div>
					<div class="form-group">
						<label class="control-label">Design Type</label>
						<input type="text" name="type" class="form-control" value="{{ $order->jenis_design }}" disabled>
					</div>
					<div class="form-group">
						<label class="control-label">Package price</label>
						<input type="text" name="packprice" value="{{ 'IDR'.$order->min_price.' - IDR'.$order->max_price }}" class="form-control" disabled>
					</div>
					<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
						<label class="control-label" for="price">Project Price</label>
						<input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control" required>

						@if($errors->has('price'))
							<span class="help-block">
								<strong>{{ $errors->first('price') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Approve Order" class="btn btn-success mont">
						<a href="{{ url('admin/order/reject/'.$order->id_order) }}" class="btn btn-danger mont">Reject order</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection