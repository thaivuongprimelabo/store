@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ trans('auth.sidebar.products.colors') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">{{ trans('auth.sidebar.products.products_colors') }}</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-xs-12">
          @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('auth.colors.list_title') }}</h3>
              <button type="button" id="create" class="btn btn-warning pull-right">{{ trans('auth.button.create') }}</button>
            </div>
            <!-- /.box-header -->
            <div id="ajax_list">
            @include('auth.products.colors.ajax_list')
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@include('auth.products.colors.modal')
@endsection
@section('script')
<script type="text/javascript">

	$('.my-colorpicker1').colorpicker();

	$('#create').click(function(e) {
		$('#colorModal').modal('toggle');
	});

	$('#color_modal_submit').click(function(e) {
		var data = {
			name: $('#name').val(),
			id: $('#id').val(),
			status: $('#status').parent().hasClass('checked') ? 1 : 0,
			type: 'post',
			async: false
		};
		var output = callAjax('{{ route('colors') }}', data, 'add-color');
		if(output.id !== undefined) {
			if(data.id !== '') {
				alert('{{ trans('messages.UPDATE_SUCCESS') }}');
			} else {
				alert('{{ trans('messages.CREATE_SUCCESS') }}');
			}
			window.location='{{ route('auth_products_colors') }}';
		}
	});

	$('.edit').click(function(e) {
		var tr = $(this).parent().parent();
		var td = tr.find('td');

		var id = td[0].innerHTML;
		var name = $(td[1]).find('input[type="hidden"]').val();
		var status = $(td[2]).find('a').attr('data-status');

		$('#name').val(name);
		$('#id').val(id);
		if(status === '1') {
			$('#status').prop('checked', true);
			$('#status').parent().addClass('checked');
			$('#status').parent().attr('aria-checked', true);
		} else {
			$('#status').prop('checked', false);
			$('#status').parent().removeClass('checked');
			$('#status').parent().attr('aria-checked', false);
		}
		
		$('#colorModal').modal('toggle');
	});

</script>
@endsection