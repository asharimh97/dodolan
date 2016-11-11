@extends('layouts.dodolan2')
@section('title', $user->name)
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row">
			<aside class="col-md-3">
				<!-- Show profile picture here -->
				ini sidebar, nampilin foto, nama lengkap udah itu aja
			</aside>
			<div class="col-md-9">
				isi profile, riwayat order, statistik boleh juga, portfolio berkaitan sama orang ini
			</div>
		</div>
	</div>
</section>
@endsection