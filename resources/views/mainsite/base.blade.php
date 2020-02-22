<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Timnha3mien</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset ('css/mainsite/bootstrap.min.css') }}">
	<!-- Dropdown hover -->
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/mainsite/animate.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/mainsite/bootstrap-dropdownhover.min.css') }}">
	<!-- My css -->
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/mainsite/style1.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/mainsite/login-css.css') }}">
	 <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/homepage.png') }}" />
	<style>
		@import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');
	</style>

</head>
<body>
	
	{{-- Including --}}
	@include('mainsite.partials.header')
	@include('mainsite.partials.nav')
	@yield('content')
	@include('mainsite.partials.footer')
	{{-- Javascript --}}
	<script type="text/javascript" src="{{ asset('js/mainsite/jquery-3.3.1.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('js/mainsite/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/mainsite/login-jq.js') }}"></script>
	@stack('scripts')
	
</body>
</html>