@extends('layouts.dodolan')

@section('content')
<section id="hero-header">
	<div class="container rel-pos">
		<section class="header-hero">
			<div class="col-md-12 nowrap">
				<div class="head-hero-content nowrap" style="background: url({{asset('assets/img/portfolios-3.jpg')}}) ;">
					<div class="head-overlay">
						<div class="hero-inside">
							<div class="hero-inside-content">
								<p>LOGO DESIGN</p>
							</div>
						</div>
					</div>
				</div>
				<div class="head-hero-content-2 nowrap" style="background: url({{asset('assets/img/portfolios-17.jpg')}}) ;">
					<div class="head-overlay">
						<div class="hero-inside">
							<div class="hero-inside-content-2">
								<p>GRAPHIC DESIGN</p>
							</div>
						</div>
					</div>
				</div>
				<div class="head-hero-content-2 nowrap" style="background: url({{asset('assets/img/portfolios-14.jpg')}}) ;">
					<div class="head-overlay">
						<div class="hero-inside">
							<div class="hero-inside-content-2">
								<p>CARD DESIGN</p>
							</div>
						</div>
					</div>
				</div>
				<p>
					<br><br><br><br><br><br><br><br>
					<h1 class="text-right">DODOLAN DESIGN</h1>
					<p class="text-right sub-content">Getting confused of making a stunning design, no worry we are here to help you make a good design and print it, just have your seat, give us the brief, we do the rest.</p>
					<p class="text-right"><a href="{{ url('/about') }}" type="button" class="btn btn-default">ABOUT US</a></p>
				</p>
			</div>
		</section>
	</div>
</section>
<!-- How it works -->
<section id="works" class="dd-frame pd-bt-30">
	<div class="container">
		<div class="row pd-bt-10">
			
			<h2 class="content-title title-turqoise">How it works</h2>
			<hr class="content-border turqoise" />

		</div>

		<div class="row pd-bt-10">
			<div class="col-md-6">
				<img src="{{ asset('assets/img/works-1.png') }}" class="head-img pd-10">
			</div>
			<div class="col-md-6">
				<div class="col-md-10">
					
					<h2 class="content-subtitle">
						<table>
							<tr>
								<td rowspan="2" class="pd-lr-20 content-title">1</td>
								<td>Write down</td>
							</tr>
							<tr>
								<td>your design brief</td>
							</tr>
						</table>
					</h2>
					<p class="litbig">Tell us everything about the dream design you want. Write all the requirement to us, for a better design you will need more detail brief.</p>

				</div>
			</div>
		</div>
		<div class="row pd-bt-10">
			<div class="col-md-6">
				<div class="col-md-10">
					<div class="col-md-12">
						<h2 class="content-subtitle text-right pull-right">
							<table>
								<tr>
									<td>Pick the package</td>
									<td rowspan="2" class="pd-lr-20 content-title">2</td>
								</tr>
								<tr>
									<td>suits you very well</td>
								</tr>
							</table>
						</h2>
					</div>
					<p class="text-right litbig">We provide you some package to satisfy you with our working. Just choose one of them and you will get the service as you want to.</p>

				</div>
			</div>
			<div class="col-md-6">
				<img src="{{ asset('assets/img/works-2.png') }}" class="head-img pd-10">
			</div>
		</div>
		<div class="row pd-bt-10">
			<div class="col-md-6">
				<img src="{{ asset('assets/img/works-3.png') }}" class="head-img pd-10">
			</div>
			<div class="col-md-6">
				<div class="col-md-10">
					
					<h2 class="content-subtitle">
						<table>
							<tr>
								<td rowspan="2" class="pd-lr-20 content-title">3</td>
								<td>Pick the style</td>
							</tr>
							<tr>
								<td>you want to be</td>
							</tr>
						</table>
					</h2>
					<p class="litbig">Before you go, pick every design style you want to be. It will give us more inspiration to make a design that suit you well</p>

				</div>
			</div>
		</div>
		<div class="row pd-bt-10">
			<div class="col-md-6">
				<div class="col-md-10">
					
					<h2 class="content-subtitle">
						<table>
							<tr>
								<td rowspan="2" class="pd-lr-20 content-title">4</td>
								<td>Sit down</td>
							</tr>
							<tr>
								<td>and relax yourself</td>
							</tr>
						</table>
					</h2>
					<p class="text-right litbig">Finally, just sit down and relax. We will do the rest, you don't really like your design make a revision, you like and want to print it. Just tell us!</p>

				</div>
			</div>
			<div class="col-md-6">
				<img src="{{ asset('assets/img/works-4.png') }}" class="head-img pd-10">
			</div>
		</div>
	</div>
</section>
<!-- How it works /END -->
<!-- Gallery -->
<section id="gallery" class="dd-frame pd-bt-30">
	<div class="container">
		<div class="row">
			<h2 class="content-title title-orange">Our stunning gallery</h2>
			<hr class="content-border orange" />
		</div>
		<div class="row pd-bt-20">
			<div class="col-md-12 owl-carousel" id="dodolan-gallery">
			<!-- First Row -->
			@foreach ($galleries as $gallery)
				<a href="{{ url('/gallery') }}">
					<div class="gallery-content">
						<div class="gallery-overlay">
							<div class="gallery-caption pd-10">
								<h3 class="gallery-caption-title nowrap">{{$gallery->title}}</h3>
								<p>{{ substr($gallery->description, 0, 125).'...' }}</p>
								<p>
									@for($i=0; $i<$gallery->rating; $i++)
									<i class="fa fa-star"></i>
									@endfor
								</p>
							</div>
						</div>
						<img src="{{asset('/uploads/'.$gallery->picture)}}" class="gallery-img" alt="{{ $gallery->title }}" title="{{ $gallery->title }}">
					</div>
				</a>
			@endforeach	
			</div>
		</div>
	</div>
</section>
<!-- Gallery /End -->
<!-- Testimonials -->
<section id="testimoni">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
			<div id="testimonies" class="owl-carousel">
				@foreach ($testimonies as $testimoni)
				<div>
					<p>
						<img src="{{asset('assets/img/rating-'.$testimoni->rating.'.png')}}" class="rating-star" alt="Rating" title="Rating">
					</p>
					<p class="testimoni-text">"{{ $testimoni->testimoni_desc }}"</p>
					<p class="testimoni-author">- {{ $testimoni->name }} ({{ '@'.$testimoni->username }} ) -</p>
				</div>
				@endforeach

			</div>
			</div>
		</div>
	</div>
</section>
<!-- Testimonials /End -->
<!-- Teams -->
<section id="teams" class="dd-frame pd-bt-30">
	<div class="container">
		<div class="row pd-bt-20">
			<div class="col-md-12">
				<h2 class="content-title title-purple">The designers</h2>
				<hr class="content-border purple" />
			</div>
		</div>
		<div class="row pd-bt-20">
			<div class="col-md-12">
				<div id="team-member" class="owl-carousel">
				@foreach($teams as $team)
					<div class="team-item pd-bt-10">
						<div class="row pd-bt-20">
							<div class="col-md-8 col-md-offset-2">
								<img src="{{asset('uploads/'.$team->prof_pic)}}" alt="{{ $team->name }}" title="{{ $team->name }}" class="team-img">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<p class="big mont-bold nowrap">{{ $team->name }}</p>
								<p class="aller">{{ $team->role }}</p>
								<p class="pd-bt-10">
									<ul class="team-links">
										<li><a href="{{ $team->youtube }}" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play"></i></a></li>
										<li><a href="{{ $team->twitter }}" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
										<li><a href="{{ $team->facebook }}" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
										<li><a href="{{ $team->instagram }}" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a></li>
										<li><a href="{{ $team->google }}" data-toggle="tooltip" data-placement="top" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</p>
							</div>
						</div>
					</div>
					@endforeach
					
					

				</div>
			</div>
		</div>
	</div>
</section>
<!-- Teams /end -->
<!-- Contact us -->
<section id="ask" class="dd-frame pd-bt-30">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				@if (Auth::guest())
					<img src="{{ asset('assets/img/question-2.png') }}" alt="Getting confused?" title="Getting confused?" class="head-img">
				@else
					@if (Auth::user()->gender == "Perempuan")
					<img src="{{ asset('assets/img/question-1.png') }}" alt="Getting confused?" title="Getting confused?" class="head-img">
					@else
					<img src="{{ asset('assets/img/question-2.png') }}" alt="Getting confused?" title="Getting confused?" class="head-img">
					@endif
				@endif
			</div>
			<div class="col-md-6">
				
				<h2 class="content-title title-red">Confused?<br>Ask us everything</h2>
				<hr class="content-border red" />

				<div class="row pd-bt-20">
					<div class="col-md-10">
						<p class="litbig">All of our team and customer service are here to help you whenever you're getting confused. No need to worry about us, just tell us your problem or you may check the <a href="#">FAQ</a> first to ensure your question is unique.</p>
						<p class="pd-bt-10">
							<a href="{{ url('contact') }}" class="btn btn-danger pd-bt-10 pd-lr-30">Contact us &nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right text-right"></i></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="ordernow">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 text-center">
				<h1 class="mont he-1 nowrap">Then what are you waiting for?</h1>
				<p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. </p>
				<p>
					<a href="{{ url('/order') }}" class="btn btn-order pd-lr-30">Order now</a>
				</p>
			</div>
		</div>
	</div>
</section>
<section id="partners"  class="pd-bt-30">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="partner" class="owl-carousel">
					<!-- <div class="partner-item"><img src="{{asset('assets/img/partners-1.png')}}" title="Adidas" alt="Adidas"></div> -->
					<div class="partner-item"><img src="{{asset('assets/img/partners-2.png')}}" title="BNI" alt="BNI"></div>
					<div class="partner-item"><img src="{{asset('assets/img/partners-3.png')}}" title="BRI" alt="BRI"></div>
					<div class="partner-item"><img src="{{asset('assets/img/partners-4.png')}}" title="JNE" alt="JNE"></div>
					<div class="partner-item"><img src="{{asset('assets/img/partners-5.png')}}" title="Tiki" alt="Tiki"></div>
					<div class="partner-item"><img src="{{asset('assets/img/partners-6.png')}}" title="Bank Mandiri" alt="Bank Mandiri"></div>
					<div class="partner-item"><img src="{{asset('assets/img/partners-7.png')}}" title="BCA" alt="BCA"></div>
					<div class="partner-item"><img src="{{asset('assets/img/partners-8.png')}}" title="Pos Indonesia" alt="Pos Indonesia"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Contact us /end -->
@endsection