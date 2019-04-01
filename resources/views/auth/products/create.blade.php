@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'create_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			<input type="hidden" id="table" value="2" />
			@include('auth.common.create_form',['tab' => true])
            </form>
		</div>
	</div>
</section>
@endsection
@include('auth.products.add_service_modal')
@section('script')
<script type="text/javascript">
    
	var validatorEventSetting = $("#submit_form").validate({
		ignore: "",
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	jelm.parent().removeClass('has-error');
        	jelm.parent().find('span.help-block').html('');
    	},
    	rules: {
    		name: {
    			required: true,
    			maxlength: {{  Common::NAME_MAXLENGTH }},
    		},
    		price: {
        		required: true,
				maxlength: {{  Common::PRICE_MAXLENGTH }},
    		},
    	},
    	messages: {
    		name : {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.name') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.products.form.name', Common::NAME_MAXLENGTH) }}",
    		},
    		price: {
    			required : "{{ Utils::getValidateMessage('validation.required', 'auth.products.form.price') }}",
    			maxlength : "{{ Utils::getValidateMessage('validation.max.string', 'auth.products.form.price', Common::PRICE_MAXLENGTH) }}",
    		},
    	},
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
      	},
    });


    $('#save').click(function(e) {
    	$('#error_list').html('');
    });

    $('#add_new_service').click(function(e) {
    	$('#serviceModal').modal();
    });

    $('#serviceModal').on('show.bs.modal', function (event) {
    	$('#name').val('');
    });

    $('#service_submit').click(function(e) {
		var service_group_name = $('#name').val().trim();
		if(service_group_name.length > 0) {

			var max = getMax('.toy-item', 'data-index');
			var group_index = Number(max) + 1;
			$('#clone').find('.service-group-name').val(service_group_name);
			$('#clone').find('table').attr('data-index', group_index);
			var clone = $('#clone').html();
			$('#services').append(clone.replace('{service_group_name}', service_group_name));
		}
		$('#serviceModal').modal('hide');
    });

    $(document).on('click', '.remove-group', function(e) {
        if(confirm('{{ trans('messages.CONFIRM_DELETE') }}')) {
			$(this).parent().parent().remove();
        }
        return false;
    });

    $(document).on('click', '.remove-detail', function(e) {
        if(confirm('{{ trans('messages.CONFIRM_DELETE') }}')) {
			$(this).parent().parent()..parent()..parent().remove();
        }
        return false;
    });

    $(document).on('click', '.add-service-item', function(e) {
    	var parentElement = $(this).parent().parent().parent().parent();
    	var group_index = parentElement.attr('data-index');

    	var max = getMax(parentElement, 'data-row-index');
    	var row_index = Number(max) + 1;
    	parentElement.attr('data-row-index', row_index);

    	var row = 'service[' + group_index + ']';
		var service_group_name_tag = row + '[group_name]';
    	var service_name_tag = row + '[item][' + row_index + '][name]';
        var service_price_tag = row + '[item][' + row_index + '][price]';

        var service_group_name = $(this).parent().parent().parent().parent().find('.service-group-name').val();
		var service_item = $('#hidden-item').clone().removeClass('hide_element');
		service_item.find('.service-name').attr('name', service_name_tag);
		service_item.find('.service-price').attr('name', service_price_tag);

		parentElement.find('.service-group-name').attr('name', service_group_name_tag);
		service_item.insertBefore(parentElement.find('tr.add-item'));
    });

</script>
@endsection