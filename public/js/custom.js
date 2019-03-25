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
	    		switch(page) {
	    			case 'ajax_list':
	    				$('#ajax_list').html(res.data);
	    				break;
	    				
	    			case 'update_status':
	    			case 'add-size':
	    			case 'add-color':
	    				output = res.data;
	    				break;
	    			default:
	    				output = res;
	    				break;
	    		}
	    	}
	    }
	});
	return output;
}

var loadProducts = function(url) {
	var data = {
		type : 'post',
		async : false,
		sort: $('#sort').val()	
	}
	var data = callAjax(url, data, 'product-list');
	$('#product_list').html(data);
}

var search = function(url, data, page) {
	callAjax(url, data, page);
}

var checkExist = function(input) {
	var data = {
	   	type: 'post',
		async : false,
		value : input.value,
		col : input.col,
		table: input.table,
		itemName : input.itemName,
		id_check: input.id_check
	};

	var output = callAjax(input.url, data, 'check-exists');
	if(output.code === 200 && output.data.length > 0) {
		alert(output.data);
		return false;
	}
	
	return true;
}

var checkFileSize = function(element, size) {
	if (element.size > Number(size)) {
		return false;
	}
	return true;
}

var confirmDelete = function(msg) {
	if(confirm(msg)) {
		return true;
	}
	return false;
}

var getFormData = function($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

var previewImage = function(element, size, demension) {
	
	var arr = demension.split('x');
	var tagA = element.parent().find('.upload_image');
	var input = element[0].files[0];
//	if(checkFileSize(input, size)) {
		var reader = new FileReader();
	    reader.onload = function (event) {
	        var img = '<img src="' + event.target.result + '" style="width:' + arr[0] + 'px; height:' + arr[1] + 'px" />';
	        //if(element.name == 'image_upload[]') {
	        	var remove = '<a href="javascript:void(0)" class="remove"><i class="fa fa-trash" aria-hidden="true"></i></a>';
	        //}
	        tagA.html(img);
	        tagA.parent().append(remove);
	    }
	    reader.readAsDataURL(input);
//	}
}

var previewImageProduct = function(element, size, demension, container) {
	
	var arr = demension.split('x');
	var tagA = element.parent().find('.upload_image');
	var input = element[0].files[0];
	var reader = new FileReader();
    reader.onload = function (event) {
        $(container).attr('src', event.target.result);
    }
    reader.readAsDataURL(input);
}

var customErrorValidate = function(error, element) {
	if(error[0].innerHTML !== '') {
		if(element[0].type !== 'file') {
			element.parent().addClass('has-error');
			element.parent().find('span.help-block').html(error[0].innerHTML);
		} else {
			element.parent().parent().parent().addClass('has-error');
			element.parent().parent().parent().find('span.help-block').html(error[0].innerHTML);
		}
	}
}

var checkSizeMultiFile = function(element, param, input_message) {
	var message = '';
	if (element.attr("type") === "file") {
		
		var element = document.getElementsByName(element.attr('name'));
		if (element.length) {
    		for (i = 0; i < element.length; i++) {
				file = element[i].files[0];
				// Grab the mimetype from the loaded file, verify it matches
				if(file) {
					if(!checkFileSize(file, param)) {
						var msg = input_message.replace(':file', file.name);
						message += '<span class="help-block">' + msg + '</span>';
					}
				}
				
			}
		}
	}
	return message;
}

var checkExtMultiFile = function(element, param, input_message) {
	var message = '';
	if (element.attr("type") === "file") {
		
		var element = document.getElementsByName(element.attr('name'));
		if (element.length) {
    		for (i = 0; i < element.length; i++) {
				file = element[i].files[0];
				// Grab the mimetype from the loaded file, verify it matches
				if(file) {
					var param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|gif";
					var check = file.name.match( new RegExp( "\\.(" + param + ")$", "i" ) );
					if(!check) {
						var msg = input_message.replace(':file', file.name);
						message += '<span class="help-block">' + msg + '</span>';
					}
				}
				
			}
		}
	}
	return message;
}

var checkFileUpload = function(element, params, message, container) {
	var error_msg = checkExtMultiFile(element, params[0], message);
	error_msg += checkSizeMultiFile(element, params[1], message);

	if(error_msg !== '') {
		$(container).addClass('has-error');
		$(container).append(error_msg);
		return false;
	}
	return true;
}


var uploadByComputer = function(index) {
	var container = $('#img_' + index).find('.upload_image_product')
	container.click();
}

var uploadByUrl = function(src) {
	$('#preview').attr('src', src);
}

var selectImage = function(index, demension) {
	var img = $('#preview').attr('src');
	var arr = demension.split('x');
	$('#img_' + index).css({'display': 'inline-block'});
	$('#img_' + index).find('a').html('<img src="' + img + '" style="width:' + arr[0] + 'px; height:' + arr[1] + 'px" />');
	if(img.indexOf('http') !== -1 || img.indexOf('https') !== -1) {
		$('#img_' + index).find('.upload_image_product_url').val(img);
	}
	$('#uploadModal').modal('toggle');
}

$(document).ready(function() {
	
	$.validator.addMethod( "extension", function( value, element, param ) {
    	param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|gif";
    	return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
    });
    
    // Accept a value from a file input based on a required mimetype
    $.validator.addMethod("accept", function(value, element, param) {
    	// Split mime on commas in case we have multiple types we can accept
    	var typeParam = typeof param === "string" ? param.replace(/\s/g, "").replace(/,/g, "|") : "image/*",
    	optionalValue = this.optional(element),
    	i, file;
    
    	// Element is optional
    	if (optionalValue) {
    		return optionalValue;
    	}
    
    	if ($(element).attr("type") === "file") {
    		// If we are using a wildcard, make it regex friendly
    		typeParam = typeParam.replace(/\*/g, ".*");
    
    		// Check if the element has a FileList before checking each file
    		if (element.files && element.files.length) {
    			for (i = 0; i < element.files.length; i++) {
    				file = element.files[i];
    				// Grab the mimetype from the loaded file, verify it matches
    				if (!file.type.match(new RegExp( ".?(" + typeParam + ")$", "i"))) {
    					return false;
    				}
    			}
    		}
    	}
    
    	// Either return true because we've validated each file, or because the
    	// browser does not support element.files and the FileList feature
    	return true;
    });
    
    $.validator.addMethod( "filesize", function( value, element, param ) {
    	if ($(element).attr("type") === "file") {
    		var input = element.files[0];
    		if(input) {
    			return checkFileSize(input, param);
    		}
    	}
    	return true;
    });
    
    $.validator.addMethod("filesize_multi", function( value, element, params ) {
    	var param = params.split(',');
    	var check = true;
    	if ($(element).attr("type") === "file") {
    		var element = document.getElementsByName($(element).attr('name'));
    		if (element.length) {
	    		for (i = 0; i < element.length; i++) {
					file = element[i].files[0];
					// Grab the mimetype from the loaded file, verify it matches
					if(file && check) {
						check = checkFileSize(file, param[0]);
					}
				}
    		}
    	}
    	return check;
    }, function(params, element) {
    	var param = params.split(',');
    	var message = '';
    	if ($(element).attr("type") === "file") {
    		var element = document.getElementsByName($(element).attr('name'));
    		if (element.length) {
	    		for (i = 0; i < element.length; i++) {
					file = element[i].files[0];
					// Grab the mimetype from the loaded file, verify it matches
					if(file) {
						if(!checkFileSize(file, param[0])) {
							var msg = param[1].replace(':file', file.name);
							message += '<span class="help-block">' + msg + '</span>';
						}
					}
					
				}
    		}
    	}
    	return message;
    });
    
    $.validator.addMethod("extension_multi", function( value, element, params ) {
    	var param = params.split(',');
    	var check = true;
    	if ($(element).attr("type") === "file") {
    		var element = document.getElementsByName($(element).attr('name'));
    		if (element.length) {
	    		for (i = 0; i < element.length; i++) {
					file = element[i].files[0];
					// Grab the mimetype from the loaded file, verify it matches
					if(file && check) {
						var param1 = typeof param[0] === "string" ? param[0].replace( /,/g, "|" ) : "png|jpe?g|gif";
						check = value.match( new RegExp( "\\.(" + param1 + ")$", "i" ) );
					}
				}
    		}
    	}
    	return check;
    }, function(params, element) {
    	var param = params.split(',');
    	var message = '';
    	if ($(element).attr("type") === "file") {
    		var element = document.getElementsByName($(element).attr('name'));
    		if (element.length) {
	    		for (i = 0; i < element.length; i++) {
					file = element[i].files[0];
					// Grab the mimetype from the loaded file, verify it matches
					if(file) {
						var param1 = typeof param[0] === "string" ? param[0].replace( /,/g, "|" ) : "png|jpe?g|gif";
						var check = file.name.match( new RegExp( "\\.(" + param1 + ")$", "i" ) );
						if(!check) {
							var msg = param[1].replace(':file', file.name);
							message += '<span class="help-block">' + msg + '</span>';
						}
					}
					
				}
    		}
    	}
    	return message;
    });
    
});