@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ trans('auth.sidebar.products.products_sizes') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">{{ trans('auth.sidebar.products.products_sizes') }}</li>
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
              <h3 class="box-title">{{ trans('auth.sizes.list_title') }}</h3>
              <button type="button" id="create" class="btn btn-warning pull-right">{{ trans('auth.button.create') }}</button>
            </div>
            <!-- /.box-header -->
            <div id="ajax_list">
            @include('auth.products.sizes.ajax_list')
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@include('auth.products.sizes.modal')
@endsection
@section('script')
<script type="text/javascript">
	$('#create').click(function(e) {
		$('#sizeModal').modal('toggle');
	});

	$('#size_modal_submit').click(function(e) {
		var data = {
			name: $('#name').val(),
			id: $('#id').val(),
			status: $('#status').parent().hasClass('checked') ? 1 : 0,
			type: 'post',
			async: false
		};
		var output = callAjax('{{ route('sizes') }}', data, 'add-size');
		if(output.id !== undefined) {
			if(data.id !== '') {
				alert('{{ trans('messages.UPDATE_SUCCESS') }}');
			} else {
				alert('{{ trans('messages.CREATE_SUCCESS') }}');
			}
			window.location='{{ route('auth_products_sizes') }}';
		}
	});

	$('.edit').click(function(e) {
		var tr = $(this).parent().parent();
		var td = tr.find('td');

		var id = td[0].innerHTML;
		var name = td[1].innerHTML;
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
		
		$('#sizeModal').modal('toggle');
	});

</script>
@endsection