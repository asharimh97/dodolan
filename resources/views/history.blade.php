@extends ('layouts.dodolan2')
@section ('title', 'Recent Activity')
@section ('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
			<!-- Prodile sidebar -->
			<aside class="col-md-3">
				<div class="profile-frame">
					<div class="col-md-12">
						<div class="row pd-bt-30">
							<div class="col-md-8 col-md-offset-2">
								<img src="{{ asset('assets/'.$user->prof_pic) }}" title="{{ $user->name }}" alt="{{ $user->name }}" class="profile-picture">
							</div>
						</div>
							<p class="big nowrap">{{ $user->name }}</p>
							<p>{{ $user->email }}</p>
					</div>
				</div>
				<div class="profile-link">
					<ul class="profile-detail">
						<li><a href="{{ url('profile/'.$user->id) }}"><i class="fa fa-user"></i> Profile</a></li>
						@if(Auth::user()->id == $user->id)
						<li><a href="{{ url('setting/'.$user->id) }}"><i class="fa fa-gears"></i> Setting</a></li>
						@endif
						<li class="active"><a href="{{ url('recent/'.$user->id) }}"><i class="fa fa-calendar"></i> Recent Activity</a></li>
					</ul>
				</div>
			</aside>
			<!-- /Profile sidebar -->
			<!-- Profile content -->
			<div class="col-md-9">
				Isi nya history tentang orderan si pengguna, se detail detailnya, termasuk sample yang diambil
			</div>
			<!-- /Profile content -->
		</div>
	</div>
</section>
@endsection