<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(!Utils::blank($config['web_ico']))
    <link rel="shortcut icon" href="{{ $config['web_ico'] . '?t=' . time() }}">
    @endif

    <title>{{ trans('auth.title') }}</title>

    <!-- Styles -->
    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ url('admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('admin/plugins/iCheck/square/blue.css') }}">
  
  <link rel="stylesheet" href="{{ url('admin/dist/css/skins/_all-skins.min.css') }}">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .nopadding {
       padding: 0 !important;
       margin: 0 !important;
    }
    .thumb{
      margin-bottom: 4px;
      margin-right:4px;
    }
    .selected {
        background: #f0f0f0;
        display: inline-block;
    }
    .add_image, .upload_image {
        display:table-cell;
        background: #f0f0f0;
        text-align: center;
        vertical-align: middle;
    }
    
    .add_image i, .upload_image i {
        font-size: 36px;
    }
    
    .image_product {
        position: relative;
        margin: 5px;
    }
    
    .image_product:hover .remove {
        display: block;
    }
    
    .image_product .remove {
        position: absolute;
        top: 4px;
        right: 4px;
        font-size: 18px;
        display: none;
    }
  </style>
</head>
@if(Auth::guest())
<body class="hold-transition login-page">
@yield('content')
@else
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">
          	@if(!Utils::blank($config['web_logo']))
          	<img src="{{ $config['web_logo'] }}" width="{{ Common::WEB_LOGO_ADMIN_SMALL_WIDTH }}" height="{{ Common::WEB_LOGO_ADMIN_SMALL_HEIGHT }}" />
          	@endif
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
          @if(!Utils::blank($config['web_logo']))
          <img src="{{ $config['web_logo'] }}" width="{{ Common::WEB_LOGO_ADMIN_WIDTH }}"  height="{{ Common::WEB_LOGO_ADMIN_HEIGHT }}" />
          @endif
          </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
    
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ Utils::getAvatar(Auth::user()->avatar) }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ Utils::getAvatar(Auth::user()->avatar) }}" class="img-circle" alt="User Image">
    
                    <p>
                      {{ Auth::user()->name }}
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ route('auth_profile') }}" class="btn btn-default btn-flat">{{ trans('auth.button.profile') }}</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat">{{ trans('auth.button.logout') }}</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
  	</header>
  	@include('auth.common.sidebar')

   	<div class="content-wrapper">
	@yield('content')
	</div>
	
	<footer class="main-footer">
        Copyright &copy; {{ date('Y') }}. All rights
        reserved.
    </footer>
</div>
@endif
<!-- jQuery 3 -->
<script src="{{ url('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ url('admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ url('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ url('admin/bower_components/moment/min/moment.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ url('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ url('admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('admin/dist/js/demo.js') }}"></script>
<!-- CK Editor -->
<script src="{{ url('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('admin/js/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ url('js/custom.js') }}"></script>

<script>
  $(function () {
	setTimeout(function(){ 
		$('.alert').fadeOut();
	}, 3000);
	  
    //bootstrap WYSIHTML5 - text editor
    if($("#editor1").length > 0){
        CKEDITOR.replace('editor1');
        CKEDITOR.config.height = 400;
    }
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
    $('.sidebar-menu').tree();

	$(document).on('click', '.page_number', function(e) {
		var url = $('#search').attr('data-url');
		var page = $(this).attr('data-page');
		var data = getFormData($('#search_form'));
		data['type'] = 'post';
		data['async'] = false;
		url = url + '?page=' + page;
		search(url, data, 'ajax_list');
	});

	$(document).on('click', '#search', function(e) {
		var url = $(this).attr('data-url');
		var data = getFormData($('#search_form'));
		data['type'] = 'post';
		data['async'] = false;
		search(url, data, 'ajax_list');
	});

	$(document).on('click', '.edit', function(e) {
			var url = $(this).attr('data-url');
			window.location = url;
	});

	$(document).on('click', '.remove', function(e) {
		if(confirmDelete('{{ trans('messages.CONFIRM_DELETE') }}')) {
			$(this).parent().remove();
			return true;
		}
		return false;
	});

	$(document).on('click', '.remove-row', function(e) {
		if(confirmDelete('{{ trans('messages.CONFIRM_DELETE') }}')) {
			window.location = $(this).attr('data-url');
			return true;
		}
		return false;
	});

	$(document).on('click', '.update-status', function(e) {
		var table = $(this).attr('data-tbl');
		var data = {
			type : 'post',
			async : false,
			id : $(this).attr('data-id'),
			current_status: $(this).attr('data-status'),
			table: table
		}

		var res = callAjax('{{ route('update_status') }}', data, 'update_status');
		console.log(res);
		$(this).attr('data-status', res.status);
		if(res.status === '1') {
			$(this).find('span').attr('class', 'label label-success');
		} else {
			$(this).find('span').attr('class', 'label label-danger');
		}
		$(this).find('span').html(res.text);
	});

	$(document).on('click', '.upload_image', function(e) {
		$(this).next('input[type="file"]').click();
	});

	$(document).on('click', '.add_image', function(e) {
		var clone = $('.image_product_clone').clone();
		clone.attr('class', 'image_product');
		clone.attr('style', 'display:inline-block');
		$(this).parent().before(clone);
	});

	$('input#check_all').on('ifChecked', function(event){
		$('input[name="check_remove"]').prop('checked', true);
		$('input[name="check_remove"]').parent().addClass('checked');
	});

	$('input#check_all').on('ifUnchecked', function(event){
		$('input[name="check_remove"]').prop('checked', false);
		$('input[name="check_remove"]').parent().removeClass('checked');
	});

    $('button[type="submit"]').click(function(e) {
		$('form').submit();
    });

  });
</script>
@yield('script')
</body>
</html>
