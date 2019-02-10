var callAjax = function(url, data, page) {
	var output = {};
	$.ajax({
	    url: url,
	    type: data.type,
	    data: data,
	    async: data.async,
	    headers: {
	    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    success: function (res) {
	    	if(res.code === 200) {
	    		output['code'] = res.code;
				if(page == 'product-list') {
					output['data'] = res.data;
					output['paging'] = res.paging;
				}
				
				if(page == 'add-item') {
					output['top_cart'] = res.top_cart;
				}
				
				if(page == 'remove-item' || page == 'update-item') {
					output['top_cart'] = res.top_cart;
					output['main_cart'] = res.main_cart;
				}
				
				if(page == 'checkout') {
					output['order_id'] = res.order_id;
				}
	    	}
	    }
	});

	return output;
}

var addItem = function(url, item, qty) {
	var item = JSON.parse(item);
	item['qty'] = qty !== undefined ? qty : 1;
	var data = {
		type : 'post',
		async : false,
		item: item		
	}
	var output = callAjax(url, data, 'add-item');
	$('#top-cart').html(output.top_cart);
	
}

var removeItem = function(url, id) {
	var data = {
		type : 'post',
		async : false,
		id: id		
	}
	var output = callAjax(url, data, 'remove-item');
	$('#top-cart').html(output.top_cart);
	$('#main-cart').html(output.main_cart);
}

var updateItem = function(url) {
	var qty = $('.input');
	var items = [];
	for(var i = 0; i < qty.length; i++) {
		if(qty[i].value !== '') {
			var item = {id: $(qty[i]).attr('data-id'), qty: $(qty[i]).val()};
			items.push(item)
		}
	}
	
	var data = {
		type : 'post',
		async : false,
		items: items		
	}
	var output = callAjax(url, data, 'update-item');
	$('#top-cart').html(output.top_cart);
	$('#main-cart').html(output.main_cart);
}

var checkout = function(url) {
	var data = {
		type : 'post',
		async : false,
		checkout: {
			customer_name: $('input[name="name"]').val(),
			customer_email: $('input[name="email"]').val(),
			customer_address: $('input[name="address"]').val(),
			customer_phone: $('input[name="tel"]').val(),
			payment_method: $('input[name="payments"]:checked').val()
		}		
	}
	
	var output = callAjax(url, data, 'checkout');
	if(output.order_id) {
		$('#checkout-success').show();
		$('#cart').hide();
	}
}


var loadProducts = function(url) {
	var data = {
		type : 'post',
		async : false,
		sort: $('#sort').val()	
	}
	var output = callAjax(url, data, 'product-list');
	$('#product_list').html(output.data);
	$('#paging_link').html(output.paging);
}