<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="Bingung membuat dan mencetak design dengan mudah? Dodolan Design ada untuk membantuk Anda membuat design yang menarik dan mencetaknya">
	<meta name="author" content="Surabi">
	<meta name="keywords" content="Design, Design grafis, cetak design, dodolan design">
	<meta name="robots" content="index, follow">
	<meta name="copyright" content="Surabi Team, 2016">

	<title>{{config('app.name', 'Dodolan Design')}}</title>

	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/app.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.theme.css')}}">

	<!-- Shortcut icon -->
	<link rel="shortcut icon" type="x-icon" href="{{asset('assets/img/logo.png')}}">
</head>
<body>
<div id="up">
	<a href="#home"><i class="fa fa-chevron-up"></i></a>
</div>
<header class="header" id="home">
	<!-- Header goes here -->
	<nav id="main-nav" class="navbar navbar-default transparent">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
		          <span class="sr-only">Toggle navigation</span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </button>
		        <a href="{{ url('/') }}" class="navbar-brand">
		        	<img src="{{asset('assets/img/logo.png')}}" alt="Dodolan Design" title="Dodolan Design">
		        </a>
			</div>

			<div class="collapse navbar-collapse" id="menu">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ url('/') }}#home">HOME</a></li>
					<li><a href="{{url('/')}}#works">HOW IT WORKS</a></li>
					<li><a href="{{url('/gallery')}}">GALLERY</a></li>
					<li><a href="{{url('order')}}">ORDER</a></li>
					@if(Auth::guest())
						<li><a href="{{url('/login')}}">LOGIN</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<?php 
								$user = Auth::user()->name ;
								$exp = explode(" ", $user) ;
							?>
								{{ $exp[0] }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								@if(Auth::user()->role == 'user')
								<li><a href="{{ url('/home/') }}">Dashboard</a></li>
								@else
								<li><a href="{{ url('/dashboard/') }}">Dashboard</a></li>
								@endif
								<li><a href="{{ url('/profile/'.Auth::user()->id) }}">Profile</a></li>
								<li><a href="{{ url('/setting/'.Auth::user()->id) }}">Setting</a></li>
								<li>
									<a href="{{ url('logout') }}"
										onclick="event.preventDefault(); document.getElementById('logout-form').submit(); ">
										Logout</a>

									<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>

							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
</header>
<section id="page-title" class="pd-bt-20">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="mont-bold">@yield('title')</h1>
			</div>
		</div>
	</div>
</section>

@yield('content')

<footer id="footer" class="pd-bt-20">
	<!-- Footer goes here -->
	<section id="links" class="pd-bt-20">
		<div class="container">
			<div class="row">
				<div class="col-md-3 text-center">
					<p><img src="{{asset('assets/img/logo.png')}}" class="logo-dd" alt="Dodolan Design" title="Dodolan Design"></p>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. 
					</p>
					<p>
						<ul class="social-links">
							<li><a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play"></i></a></li>
							<li><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#" data-toggle="tooltip" data-placement="top" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</p>
				</div>
				<div class="col-md-3">
					<h4 class="mont-bold">COMPANY</h4>
					<p>
						<ul class="dodolan-links">
							<li><a href="{{ url('/about') }}">About Us</a></li>
							<li><a href="#">Careers</a></li>
							<li><a href="{{ url('/contact') }}">Contact Us</a></li>
							<li><a href="#">Jobs</a></li>
							<li><a href="{{ url('/about') }}">Teams</a></li>
							<li><a href="{{ url('/testi') }}">Testimonials</a></li>
						</ul>
					</p>
				</div>
				<div class="col-md-3">
					<h4 class="mont-bold">LINKS</h4>
					<p>
						<ul class="dodolan-links">
							<li><a href="#">Frequently Asked Questions</a></li>
							<li><a href="{{ url('/order') }}">Pricing and Order</a></li>
							<li><a href="{{ url('/gallery') }}">Gallery</a></li>
							<li><a href="#">Term of Service</a></li>
							<li><a href="{{ url('/gallery') }}">Featured Design</a></li>
							<li><a href="#">Digital Resources</a></li>
						</ul>
					</p>
				</div>
				<div class="col-md-3">
					<h4 class="mont-bold">RECENTS</h4>
					<p>
						<ul class="dodolan-links">
							<li><a href="{{ url('/gallery') }}">AMH Logo</a></li>
							<li><a href="{{ url('/gallery') }}">Fireball Vectors</a></li>
							<li><a href="{{ url('/gallery') }}">Blue Hijab</a></li>
							<li><a href="{{ url('/gallery') }}">Business Card</a></li>
							<li><a href="{{ url('/gallery') }}">Greeting Card</a></li>
						</ul>
					</p>
				</div>
			</div>
		</div>
	</section>
	<section id="copyright pd-bt-10">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-right">
					<img src="{{asset('assets/img/surabi.png')}}" alt="Surabi" title="Surabi" class="team-logo">
					<p class="small nowrap">Designed and-developed with love in Jogja</p>
					<p class="small nowrap">Dodolan Design &copy; Surabi 2016</p>
				</div>
			</div>
		</div>
	</section>
</footer>
<script type="text/javascript" src="{{asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		// wow js
		new WOW().init() ;
		$("#up").hide() ;
		$(window).scroll(function(){
			if($(document).scrollTop() > 300){
				$("#up").fadeIn() ;
			}else{
				$("#up").fadeOut() ;
			}
		}) ;

		//owl carousel
		var owl = $("#dodolan-gallery") ;
		var tes = $("#testimonies") ;
		var partner = $("#partner") ;
		var team = $("#team-member") ;
		owl.owlCarousel({
			items : 4,
			loop : true,
			pagination : false
		}) ;

		owl.trigger('owl.play', 10000) ;

		tes.owlCarousel({
			singleItem : true,
			autoplay : true,
			autoplayTimeout : 12000,
			slideSpeed : 200
		}) ;

		partner.owlCarousel({
			items : 5,
			pagination : false
		}) ;

		team.owlCarousel({
			items : 5,
			pagination : false 
		}) ;

		// nicescroll
		$("html").niceScroll({
			cursorcolor : 'rgba(0,0,0,0.5)',
			cursorwidth : '10px',
			cursorborder : 'none',
			cursorborderradius : '0px' ,
			zindex : '101'
		}) ;

		// bellow is js function to remove the url when clicked link
		$(function() {
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });

        // tooltip
        $('[data-toggle="tooltip"]').tooltip() ;

        // laravel script
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        // another way
        $(".sample-label").click(function(){
			$(this).toggleClass("check") ;
		}) ;

	}) ;

</script>
</body>
</html>