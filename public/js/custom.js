var callAjax = function(url, data, page) {
	var output = '';
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
		    	if(page === 'vendor_ajax_list') {
					$('#vendor_list').html(res.data);
		    	}
		    	
		    	if(page === 'update_status') {
		    		output = res.data;
		    	}
	    	}
	    }
	});

	return output;
}

var search = function(url, data, page) {
	callAjax(url, data, page);
}

var checkFileSize = function(element, size) {
	if (element.files && element.files.length) {
		for (i = 0; i < element.files.length; i++) {
			file = element.files[i];
			if (file.size > Number(size)) {
				return false;
			}
		}
	}
	return true;
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
    		return checkFileSize(element, param);
    	}
    	return true;
    });

});