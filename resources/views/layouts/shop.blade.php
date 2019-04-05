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
	
	<link href="{{ url('shop/shop.custom.css') }}" rel="stylesheet" type="text/css" />
	<!-- Header JS -->	
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/jquery-2.2.3.min4d7c.js') }}" type="text/javascript"></script> 

</head>

<body>
	<header>
	@include('shop.common.header')
	@include('shop.common.main_nav')
	</header>
	@yield('content')
	@include('shop.common.footer')
	
	<!-- Plugin JS -->
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/appear4d7c.js') }}" type="text/javascript"></script>
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/owl.carousel.min4d7c.js') }}" type="text/javascript"></script>		
	<script src="{{ url('shop/maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>

	<!-- Main JS -->	
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/dl_main4d7c.js') }}" type="text/javascript"></script>
	
	<script src="https://bizweb.dktcdn.net/100/308/325/themes/665783/assets/jquery.elevatezoom308.min.js" type="text/javascript"></script>	
	<script type="text/javascript" src="{{ url('js/shop.custom.js') }}" ></script>
	<script>
		$(document).ready(function() {
			
    		 $('.zoomContainer').remove();
    		 $('#zoom_01').elevateZoom({
    			 gallery:'gallery_01', 
    			 zoomWindowWidth:420,
    			 zoomWindowHeight:500,
    			 zoomWindowOffetx: 10,
    			 easing : true,
    			 scrollZoom : false,
    			 cursor: 'pointer', 
    			 galleryActiveClass: 'active', 
    			 imageCrossfade: true
    		 });

    		 $(document).on('keyup', '#keyword', function(e) {
        		 var value = $(this).val().trim();
        		 var page_name = 'search-suggestion-page';
        		 if(value.length > 0) {
        			var data = {
    		    		type : 'post',
    		    		async : true,
    		    		keyword: $(this).val(),
    		    		page_name: page_name,
    		    		container: '#product_results',
    		    		paging: '',
    		    	}
    				$('#search_suggestion').show();
      		    	$('.show_more span').html($(this).val());
    		    	callAjax('{{ route('loadData') }}', data, page_name);
        		 } else {
        			 $('#search_suggestion').hide();
        		 }
    		 });
		});

		$(document).mouseup(function(e) {
		    var container = $("#search_suggestion");
		    if (!container.is(e.target) && container.has(e.target).length === 0) {
		        container.hide();
		    }
		});
	</script>
	@yield('script')
</body>
</html>
