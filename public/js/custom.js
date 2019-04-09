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
	if (Number(element.size) > Number(size)) {
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

var customErrorValidate = function(error, element) {
	if(error[0].innerHTML !== '') {
		console.log(element);
		if(element[0].className === 'ckeditor valid-text') {
			element.parent().addClass('has-error');
			element.parent().find('span.help-block').html(error[0].innerHTML);
		} else {
			element.parent().parent().addClass('has-error');
			element.parent().parent().find('span.help-block').html(error[0].innerHTML);
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

var checkFileUpload = function(element, params, messages, container) {
	var error_msg = checkExtMultiFile(element, params[0], messages[0]);
	error_msg += checkSizeMultiFile(element, params[1], messages[1]);

	$(container).html('');
	if(error_msg !== '') {
		$(container).addClass('has-error');
		$(container).append(error_msg);
		return false;
	}
	return true;
}


var uploadByComputer = function(id) {
	var container = $('#' + id).find('.upload_image_product')
	container.click();
}

var uploadByUrl = function(src) {
	$('#preview').attr('src', src);
}

var selectImage = function(id, demension) {
	var img = $('#preview').attr('src');
	var arr = demension.split('x');
	$('#' + id).css({'display': 'inline-block'});
	
	var className = 'upload_image';
	if(id.indexOf('edit') >= 0) {
		className = 'add_image';
	}
	
	$('#' + id).find('a.' + className).css({'width': arr[0], 'height': arr[1]});
	$('#' + id).find('a.' + className).html('<img src="' + img + '" style="width:' + arr[0] + 'px; height:' + arr[1] + 'px" />');
	if(img.indexOf('http') !== -1 || img.indexOf('https') !== -1) {
		$('#' + id).find('.upload_image_product_url').val(img);
	}
	$('#uploadModal').modal('toggle');
}

var getLinkYoutubeId = function(url) {
	var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
    	return match[2];
    }
    
    return '';
}

var formatCurrency = function (nStr, decSeperate, groupSeperate) {
  	if(nStr == null) {
  		return '0 ' + Constants.CURRENCY;
  	}
  	nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
}

var getMax = function(element, data) {
	var max = -1;
	$(element).each(function() {
	  	var value = parseInt($(this).attr(data));
	  	max = (value > max) ? value : max;
	});
	return (max + 1);
}

var readURL = function readURL(input) {
	
  if(!input.prop('multiple')) {
	  if (input[0].files && input[0].files[0]) {
		  var reader = new FileReader();
		  reader.onload = function(e) {
			  var preview_id = input.attr('data-preview-control');
			  $('#' + preview_id).attr('src', e.target.result).show();
		  }
		  reader.readAsDataURL(input[0].files[0]);
	  }
  } else {
	  var preview_id = input.attr('data-preview-control');
	  var width = input.attr('data-width');
	  var height = input.attr('data-height');
	  var length = input[0].files.length;
	  if(length > 0) {
		  for(var i = 0; i < length; i++) {
			  var reader = new FileReader();
		      reader.onload = function(e) {
		    	  var img = "<img src='" + e.target.result + "'  class='img-thumbnaili width='" + width + "' height='" + height + "' style='margin-top:10px;'>";
		    	  $('#' + preview_id).append(img);
		      }
		      
		      reader.readAsDataURL(input[0].files[i]);
		  }
	  }
  }
  
}

var errorUploadAlert = function(message) {
	var msg = '<div style="padding: 5px;">';
		  msg += '<div id="inner-message" class="alert alert-danger">';
		  msg += '<i class="fa fa-exclamation-triangle fa-2x"></i>' + message;
		  msg += '</div>';
		  msg += '</div>';
		  
	return msg;
}

$(document).ready(function() {
	
	$.validator.addMethod('required_ckeditor', function(value, element, params) {
		if (CKEDITOR.instances[element.id].getData() == '') {
	        return false;
	    }
		return true;
	});
    
});