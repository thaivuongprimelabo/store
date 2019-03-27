<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ isset($title) ? $title : trans('auth.create_box_title') }}</h3>
    </div>
    {{ csrf_field() }}
    <div class="box-body">
        @foreach($forms as $key=>$value)
        @if(is_array($value))
        	@php
        		$text = $value['text'];
        		$placeholder = isset($value['placeholder']) ? $value['placeholder'] : $text;
        		$defaultValue = isset($value['value']) ? $value['value'] : '';
        		$maxlength = isset($value['maxlength']) ? $value['maxlength'] : 120;
        		$lengthText = str_replace('{0}', $maxlength, trans('auth.length_text'));
        	@endphp
        	@if($value['type'] == 'textarea')
        		<div class="form-group ">
                  <label for="exampleInputPassword1">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <textarea class="form-control" rows="6" name="{{ $key }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}">{{ old($key) }}</textarea>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'file')
        		@php
        			if(isset($config[$key . Common::S])) {
        				$split = explode('x', $config[$key . Common::S]);
        			} else {
        				$split = explode('x', '100x100');
        			}
        			
        			if(isset($config[$key . Common::U])) {
        				$size = Utils::formatMemory($config[$key . Common::U]);
        			} else {
        				$size = 51200;
        			}
        			
        		@endphp
        		
        		@include('auth.common.upload_product',[
                	'text' => $text,
                	'text_small' => trans('auth.text_image_small'),
                	'errors' => $errors,
                	'name' => $key,
                	'size' => $size,
                	'width' => $split[0],
                	'height' => $split[1],
                	'image_using' => [],
                	'multiple' => isset($value['multiple']) ? true : false
                ])
        	@endif
        	
        	@if($value['type'] == 'select')
        		<div class="form-group">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                    <option value="">{{ $value['empty_text'] }}</option>
                  	{!! Utils::createSelectList($value['table']) !!}
                  </select>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'editor')
        		<div class="form-group ">
                  <label for="exampleInputPassword1">{{ $text }}</label>
                  <textarea name="{{ $key }}" id="editor_{{ $key }}" class="ckeditor" placeholder="{{ $placeholder }}">{{ old($key) }}</textarea>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'datepicker')
        		<div class="form-group ">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $defaultValue) }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}">
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'timepicker')
        		<div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>{{ $text }}</label>
                      <input type="text" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $defaultValue) }}" class="form-control timepicker" maxlength="{{ $maxlength }}">
                    </div>
                  </div>
        	@endif
        	
        	@if($value['type'] == 'checkbox')
        		<div class="checkbox">
                  <label>
                    <input type="checkbox" name="{{ $key }}" value="1" @if(old($key, true)) {{ 'checked="checked"' }} @endif> {{ $text }}
                  </label>
                </div>
        	@endif
        	
        	@if($value['type'] == 'text')
        		<div class="form-group ">
                  <label for="exampleInputEmail1">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $defaultValue) }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
            @if($value['type'] == 'number')
        		<div class="form-group ">
                  <label for="exampleInputEmail1">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <input type="number" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $defaultValue) }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
            @if($value['type'] == 'password')
        		<div class="form-group ">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <input type="password" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $defaultValue) }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
        	
        	@if($value['type'] == 'checkbox_multi')
        		<div class="form-group">
        			<label>{{ $text }}</label>
            		<div class="checkbox">
                      <label>
                        {!! Utils::createCheckboxList($value['table']) !!}
                      </label>
                    </div>
                </div>
        	@endif
        	
        	@if($value['type'] == 'checkbox_color_multi')
        		<div class="form-group">
        			<label>{{ $text }}</label>
            		<div class="checkbox">
                      <label>
                        {!! Utils::createCheckboxList($value['table']) !!}
                      </label>
                    </div>
                </div>
        	@endif
        @endif
        @endforeach
    </div>
</div>