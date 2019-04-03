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
    
	<link rel="stylesheet" href="{{ url('shop/cdn.linearicons.com/free/1.0.0/icon-font.min.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&amp;subset=vietnamese" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('shop/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') }}">
	<!-- Plugin CSS -->			
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/plugin.scss4d7c.css') }}" rel="stylesheet" type="text/css" />
	
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/base.scss4d7c.css') }}" rel="stylesheet" type="text/css" />		
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/style.scss4d7c.css') }}" rel="stylesheet" type="text/css" />				
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/module.scss4d7c.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/responsive.scss4d7c.css') }}" rel="stylesheet" type="text/css" />

	<!-- Theme Main CSS -->
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/bootstrap-theme4d7c.css') }}" rel="stylesheet" type="text/css" />		
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/style-theme.scss4d7c.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/responsive-update.scss4d7c.css') }}" rel="stylesheet" type="text/css" />
	
	<link href="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/iwish4d7c.css') }}" rel="stylesheet" type="text/css" />
	<!-- Header JS -->	
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/jquery-2.2.3.min4d7c.js') }}" type="text/javascript"></script> 

</head>

<body>
	<header>
	@include('shop.common.header')
	@include('shop.common.main_nav')
	</header>
	@include('shop.common.sidebar')
	@yield('content')
	@include('shop.common.footer')
	
	<!-- Bizweb javascript -->
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/option-selectors4d7c.js') }}" type="text/javascript"></script>
	<script src="{{ url('shop/bizweb.dktcdn.net/assets/themes_support/api.jquerya87f.js') }}" type="text/javascript"></script> 

	<!-- Plugin JS -->

	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/appear4d7c.js') }}" type="text/javascript"></script>
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/owl.carousel.min4d7c.js') }}" type="text/javascript"></script>		
	<script src="{{ url('shop/maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>

	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/dl_function4d7c.js') }}" type="text/javascript"></script>
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/dl_api4d7c.js') }}" type="text/javascript"></script>
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/rx-all-min4d7c.js') }}" type="text/javascript"></script>

	<!-- Quick view -->
				
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/quickview4d7c.js') }}" type="text/javascript"></script>				
	
	<!-- Main JS -->	
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/dl_main4d7c.js') }}" type="text/javascript"></script>

	<script src="{{ url('shop/ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js') }}"></script>	
</body>
</html>
