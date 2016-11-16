@extends('layouts.dodolan2')
@section('title', 'Detail Order')
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
			<div class="col-md-12">
				<h3>{{ $data->title }}</h3>
				<p>{{ $data->brief }}</p>
				<p>Sample : </p>
				@foreach ($detail as $detail)
				<div class="col-md-4 mg-bt-10">
					<img src="{{ asset('uploads/'.$detail->picture) }}" class="head-img">
				</div>
				@endforeach
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
			</div>
		</div>
	</div>
</section>
@endsection