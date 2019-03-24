<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>{{ $config['web_name'] }}</title>

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if(!Utils::blank($config['web_ico']))
    <link rel="shortcut icon" href="{{ $config['web_ico'] . '?t=' . time() }}">
    @endif
    
    @if(!Utils::blank($config['web_description']))
    <meta name="description" content="{{ $config['web_description'] }}" />
    @endif
    
    @if(!Utils::blank($config['web_keywords']))
    <meta name="keywords" content="{{ $config['web_keywords'] }}" />
    @endif
    
    <!-- ROBOTS -->
    <meta name="googlebot" content="noarchive" />
    <meta name="robots" content="noarchive" />

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ url('shop/css/bootstrap.min.css') }}" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{ url('shop/css/slick.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ url('shop/css/slick-theme.css') }}" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{ url('shop/css/nouislider.min.css') }}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ url('shop/css/font-awesome.min.css') }}">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ url('shop/css/style.css') }}" />

	<!-- HTML5 shim and Respond.js') }} for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js') }} doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
		<![endif]-->

</head>

<body>
	@include('shop.common.header')

	@include('shop.common.main_nav', ['showOnClick' => isset($showOnClick) ? true : false])
	
	@if(Route::currentRouteName() == 'home')
	@include('shop.common.carousel')
	@endif
	
	@include('shop.common.breadcrumb', ['data' => isset($breadcrumb) ? $breadcrumb : []])
	
	<!-- section -->
	<div class="section">
		@yield('content')
	</div>
	<!-- /section -->

	@include('shop.common.footer')

	<!-- jQuery Plugins -->
	<script src="{{ url('shop/js/jquery.min.js') }}"></script>
	<script src="{{ url('shop/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('shop/js/slick.min.js') }}"></script>
	<script src="{{ url('shop/js/nouislider.min.js') }}"></script>
	<script src="{{ url('shop/js/jquery.zoom.min.js') }}"></script>
	<script src="{{ url('shop/js/main.js') }}"></script>
	<script src="{{ url('admin/js/jquery.validate.js') }}"></script>
	<script src="{{ url('js/custom.shop.js') }}"></script>
	<script src="{{ url('js/custom.shop.js') }}"></script>
	@yield('script')
</body>
</html>
