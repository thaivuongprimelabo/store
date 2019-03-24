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
	    	output['code'] = res.code;
	    	if(res.code === 200) {
	    		
	    		switch(page) {
	    		
	    			case 'product-list':
	    				output['data'] = res.data;
						output['paging'] = res.paging;
	    				break;
	    			
					case 'add-item':
						output['top_cart'] = res.top_cart;			
						break;
						    				
					case 'remove-item':
					case 'update-item':
						output['top_cart'] = res.top_cart;
						output['main_cart'] = res.main_cart;
						break;
						
					case 'checkout':
						output['order_id'] = res.order_id;
						break;
						
					default:
						if(res.hasOwnProperty('data')) {
							output['data'] = res.data;
						}
					
						if(res.hasOwnProperty('paging')) {
							output['paging'] = res.paging;
						}
						
						if(res.hasOwnProperty('widget')) {
							output['widget'] = res.widget;
						}
						
						if(res.hasOwnProperty('new_captcha')) {
							output['new_captcha'] = res.new_captcha;
						}
						break;
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
	console.log(output);
	if(output.code === 404) {
		window.location = '/';
	}
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


var loadProducts = function(url, data) {
	var output = callAjax(url, data, data.page);
	if(output.code === 200) {
		$(data.container).html(output.data);
		$(data.paging).html(output.paging);
		if(data.hasOwnProperty('widget')) {
			$(data.widget).html(output.widget);
		}
	}
}

var checkCaptcha = function(url, data) {
	var output = callAjax(url, data, data.page);
	if(output.code === 200) {
		if(output.data !== '') {
			$(data.container).show();
			$(data.container).html(output.data);
			$(data.new_captcha).html(output.new_captcha);
			return false;
		}
	}
	
	return true;
}
