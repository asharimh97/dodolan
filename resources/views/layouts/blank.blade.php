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

	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/app.css')}}" media="all">
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

@yield('content')

<script type="text/javascript" src="{{asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/modernizr.js')}}"></script>
</body>
</html>