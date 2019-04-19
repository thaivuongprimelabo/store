<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	{!! SEO::generate() !!}
	<meta property="fb:app_id" content="135671569954053" />
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if(!Utils::blank($config['web_ico']))
    <link rel="shortcut icon" href="{{ $config['web_ico'] . '?t=' . time() }}">
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
	
	<link href="{{ url('shop/css/custom.shop.css') }}" rel="stylesheet" type="text/css" />
	<!-- Header JS -->	
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/jquery-2.2.3.min4d7c.js') }}" type="text/javascript"></script> 
	
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=135671569954053&autoLogAppEvents=1"></script>

</head>

<body>
	<header>
	@include('shop.common.header')
	@include('shop.common.main_nav')
	</header>
	@yield('content')
	@include('shop.common.footer')
	@include('shop.modal.add_to_cart')
	<!-- Plugin JS -->
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/appear4d7c.js') }}" type="text/javascript"></script>
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/owl.carousel.min4d7c.js') }}" type="text/javascript"></script>		
	<script src="{{ url('shop/maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>

	<!-- Main JS -->	
	<script src="{{ url('shop/bizweb.dktcdn.net/100/308/325/themes/665783/assets/dl_main4d7c.js') }}" type="text/javascript"></script>
	
	<script src="https://bizweb.dktcdn.net/100/308/325/themes/665783/assets/jquery.elevatezoom308.min.js" type="text/javascript"></script>	
	<script type="text/javascript" src="{{ url('js/custom.shop.js') }}" ></script>
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
    		    		container: ['#product_results']
    		    	}
    				$('#search_suggestion').show();
      		    	$('.show_more span').html($(this).val());
    		    	callAjax('{{ route('loadData') }}', data);
        		 } else {
        			 $('#search_suggestion').hide();
        		 }
    		 });

    		 $(document).on('click', '.show_more', function(e) {
				window.location = '{{ route('search') }}?q=' + $('#keyword').val();
    		 });

    		 $(document).on('click', '.add_to_cart', function(e) {
 				 var data = {
					type : 'post',
		    		async : true,
		    		pid: $(this).attr('data-id'),
		    		qty: $(this).attr('data-qty'),
		    		container: ['#cart_1', '.cartCount2', '#top_cart'],
		    		dialog: '#popupCartModal'
 				 }

 				 callAjax('{{ route('addToCart') }}', data);
     		 });

    		 $(document).on('click', '.btn-minus-detail', function(e) {
        		 e.stopPropagation();
        		 var qty = Number($(this).next('.number-sidebar').val()) - 1;
        		 if(qty === 0) {
					return false;
        		 }

        		 $(this).next('.number-sidebar').val(qty);

        		 var data = {
 					type : 'post',
 		    		async : true,
 		    		pid: $(this).attr('data-product-id'),
 		    		did: $(this).attr('data-id'),
 		    		qty: qty,
 		    		container: ['#top_cart', '.cartCount2', '#main_cart'],
  				 }

  				 callAjax('{{ route('updateCartDetail') }}', data);
        		 
     		 });

    		 $(document).on('click', '.btn-plus-detail', function(e) {
        		 var qty = Number($(this).prev('.number-sidebar').val()) + 1;
        		 var qty_item = Number($(this).attr('data-qty'));
        		 if(qty > qty_item) {
					return false;
        		 }

        		 $(this).next('.number-sidebar').val(qty);

        		 var data = {
 					type : 'post',
 		    		async : true,
 		    		pid: $(this).attr('data-product-id'),
 		    		did: $(this).attr('data-id'),
 		    		qty: qty,
 		    		container: ['#top_cart', '.cartCount2', '#main_cart'],
  				 }

  				 callAjax('{{ route('updateCartDetail') }}', data);
        		 
     		 });

    		 $(document).on('click', '.btn-minus-item', function(e) {
        		 var qty = Number($(this).next('.number-sidebar').val()) - 1;
        		 if(qty === 0) {
					return false;
        		 }

        		 $(this).next('.number-sidebar').val(qty);
        		 $('.qty-detail').attr('data-qty');

        		 var data = {
 					type : 'post',
 		    		async : true,
 		    		pid: $(this).attr('data-id'),
 		    		qty: qty,
 		    		container: ['#top_cart', '.cartCount2', '#main_cart'],
  				 }

  				 callAjax('{{ route('updateCart') }}', data);

        		 
     		 });
    		 
    		 $(document).on('click', '.btn-plus-item', function(e) {
        		 var qty = Number($(this).prev('.number-sidebar').val()) + 1;
        		 if(qty > 20) {
					return false;
        		 }
        		 
        		 $(this).prev('.number-sidebar').val(qty);
        		 $('.qty-detail').attr('data-qty');

        		 var data = {
  					type : 'post',
  		    		async : true,
  		    		pid: $(this).attr('data-id'),
  		    		qty: qty,
  		    		container: ['#top_cart', '.cartCount2', '#main_cart'],
   				 }

   				 callAjax('{{ route('updateCart') }}', data);
        		 
    		 });

    		 $(document).on('click', '.qtyminus', function(e) {
        		 var id = $(this).attr('data-id');
        		 var qty = Number($(this).next('.qty').val()) - 1;
        		 if(qty === 0) {
					return false;
        		 }
        		 
        		 $(this).next('.qty').val(qty);

				 $(this).parent().parent().find('.add_to_cart').attr('data-id', id);
				 $(this).parent().parent().find('.add_to_cart').attr('data-qty', qty);	 
    		 });

    		 $(document).on('click', '.qtyplus', function(e) {
    			 var id = $(this).attr('data-id');
        		 var qty = Number($(this).prev('.qty').val()) + 1;
        		 if(qty > 20) {
					return false;
        		 }
        		 
        		 $(this).prev('.qty').val(qty);

        		 $(this).parent().parent().find('.add_to_cart').attr('data-id', id);  
        		 $(this).parent().parent().find('.add_to_cart').attr('data-qty', qty);      		 
    		 });

    		 $(document).on('keyup', '.qty', function(e) {
        		 var qty = $(this).val();
        		 var id = $(this).attr('data-id');
        		 $(this).parent().parent().find('.add_to_cart').attr('data-id', id);  
        		 $(this).parent().parent().find('.add_to_cart').attr('data-qty', qty);    
     		 });

    		 $(document).on('keyup', '.number-sidebar', function(e) {
        		 var qty = $(this).val();

        		 var data = {
  					type : 'post',
  		    		async : true,
  		    		pid: $(this).attr('data-id'),
  		    		qty: qty,
  		    		container: ['#top_cart', '.cartCount2', '#main_cart'],
   				 }

   				 callAjax('{{ route('updateCart') }}', data);
     		 });

    		 $(document).on('click', '.remove-item-cart', function(e) {

        		 var data = {
  					type : 'post',
  		    		async : true,
  		    		id: $(this).attr('data-id'),
  		    		container: ['#top_cart', '.cartCount2', '#main_cart'],
  		    		checkout_btn: '#checkout_btn'
   				 }

   				 callAjax('{{ route('removeItem') }}', data);
     		 });

    		 $(document).on('click', '.remove-detail-item', function(e) {
				 var pid = $(this).attr('data-product-id');
				 var id = $(this).attr('data-id');
    			 var data = {
  					type : 'post',
  		    		async : true,
  		    		pid: pid,
  		    		id: id,
  		    		container: ['#top_cart', '.cartCount2', '#main_cart'],
   				 }

   				 callAjax('{{ route('removeDetailItem') }}', data);
     		 });

     		 $(document).on('click', '#order_checking', function(e) {
         		var value = $('#checking').val();
         		if(value.length === 0) {
             		return false;
         		}
         		
     			var data = {
  					type : 'post',
  		    		async : true,
  		    		value: $('#checking').val(),
  		    		container: ['#order_checking_list'],
   				}

   				callAjax('{{ route('orderChecking') }}', data, $(this));
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
