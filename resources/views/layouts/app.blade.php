<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('auth.title') }}</title>

    <!-- Styles -->
    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('admin/plugins/iCheck/square/blue.css') }}">
  
  <link rel="stylesheet" href="{{ url('admin/dist/css/skins/_all-skins.min.css') }}">
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ url('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
@if(Auth::guest())
<body class="hold-transition login-page">
@yield('content')
@else
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">{!! trans('auth.dashboard_page_title') !!}</span>
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
                  <img src="{{ url('admin/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ url('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
    
                    <p>
                      {{ Auth::user()->name }}
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">{{ trans('auth.button.profile') }}</a>
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
<!-- AdminLTE App -->
<script src="{{ url('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('admin/dist/js/demo.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ url('admin/js/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ url('js/custom.js') }}"></script>

<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $('.wysihtml_editor').wysihtml5()
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
    $('.sidebar-menu').tree();

	$(document).on('click', '.page_number', function(e) {
		var url = $('#search').attr('data-url');
		var data = {
			type : 'post',
			async : false,
			search_data : $('#search_data').val()
		}
		var page = $(this).attr('data-page');
		url = url + '?page=' + page
		search(url, data, 'ajax_list');
	});

	$(document).on('click', '#search', function(e) {
		var url = $(this).attr('data-url');
		var data = getFormData($('#search_form'));
		data['type'] = 'post';
		data['async'] = false;
		search(url, data, 'ajax_list');
	});

	$(document).on('click', '.remove', function(e) {
		if(confirmDelete('{{ trans('messages.CONFIRM_DELETE') }}')) {
			var url = $(this).attr('data-url');
			window.location = url;
		}
	});

	$(document).on('click', '.edit', function(e) {
			var url = $(this).attr('data-url');
			window.location = url;
	});

	$(document).on('click', '.update-status', function(e) {
		var data = {
			type : 'post',
			async : false,
			id : $(this).attr('data-id'),
			current_status: $(this).attr('data-status'),
			table: 0
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
	

  });
</script>
@yield('script')
</body>
</html>
