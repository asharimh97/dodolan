@extends('layouts.dodolan2')
@section('title', 'Detail Order')
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p>{{ var_dump($order) }}</p>
			</div>
		</div>
	</div>
</section>
@endsection