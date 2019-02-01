<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Twitter Bootstrap shopping cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Bootstrap styles -->
<link href="{{ url('shop/assets/css/bootstrap.css') }}" rel="stylesheet" />
<!-- Customize styles -->
<link href="{{ url('shop/assets/css/style.css') }}" rel="stylesheet" />
<!-- font awesome styles -->
<link href="{{ url('shop/assets/font-awesome/css/font-awesome.css') }}"
	rel="stylesheet">
<!--[if IE 7]>
			<link href="css/font-awesome-ie7.min.css" rel="stylesheet">
		<![endif]-->

<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js') }}"></script>
		<![endif]-->

<!-- Favicons -->
<link rel="shortcut icon"
	href="{{ url('shop/assets/ico/favicon.ico') }}">
</head>
<body>
	<!-- 
	Upper Header Section 
-->
	@include('shop.common.top_nav')

	<!--
Lower Header Section 
-->
	<div class="container">
		@include('shop.common.header')

		<!--
Navigation Bar Section 
-->
		@include('shop.common.main_nav')
		<!-- 
Body Section 
-->
		<div class="row">
			@include('shop.common.sidebar')
			<div class="span9">
				@yield('content')
				
			</div>
		</div>
		<!-- 
Clients 
-->
		@include('shop.common.vendor')

		<!--
Footer
-->
		@include('shop.common.footer')
	</div>
	<!-- /container -->

	<div class="copyright">
		<div class="container">
			<p class="pull-right">
				<a href="#"><img src="{{ url('shop/assets/img/maestro.png') }}"
					alt="payment"></a> <a href="#"><img
					src="{{ url('shop/assets/img/mc.png') }}" alt="payment"></a> <a
					href="#"><img src="{{ url('shop/assets/img/pp.png') }}"
					alt="payment"></a> <a href="#"><img
					src="{{ url('shop/assets/img/visa.png') }}" alt="payment"></a> <a
					href="#"><img src="{{ url('shop/assets/img/disc.png') }}"
					alt="payment"></a>
			</p>
			<span>Copyright &copy; 2013<br> bootstrap ecommerce shopping template
			</span>
		</div>
	</div>
	<a href="#" class="gotop"><i class="icon-double-angle-up"></i></a>
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{ url('shop/assets/js/jquery.js') }}"></script>
	<script src="{{ url('shop/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('shop/assets/js/jquery.easing-1.3.min.js') }}"></script>
	<script
		src="{{ url('shop/assets/js/jquery.scrollTo-1.4.3.1-min.js') }}"></script>
	<script src="{{ url('shop/assets/js/shop.js') }}"></script>
</body>
</html>