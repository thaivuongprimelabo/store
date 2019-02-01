<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ isset($title) ? $title : trans('auth.create_box_title') }}</h3>
    </div>
    {{ csrf_field() }}
    <div class="box-body">
        @foreach($forms as $key=>$value)
        @if(is_array($value))
        	@if($value['type'] == 'textarea')
        		<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                  <label for="exampleInputPassword1">{{ $value['text'] }}</label>
                  <textarea class="form-control" rows="6" name="{{ $key }}" placeholder="{{ $value['text'] }}" maxlength="{{ Common::DESC_MAXLENGTH }}">{{ old($key) }}</textarea>
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
        		@if(!isset($multiple))
            		@include('auth.common.upload',[
                    	'text' => $value['text'],
                    	'text_small' => trans('auth.text_image_small'),
                    	'errors' => $errors,
                    	'name' => $key,
                    	'size' => $size,
                    	'width' => $split[0],
                    	'height' => $split[1],
                    	'image_using' => ''
                    ])
                @else
                	@include('auth.common.upload_product',[
                	'text' => $value['text'],
                	'text_small' => trans('auth.text_image_small'),
                	'errors' => $errors,
                	'name' => $key,
                	'size' => $size,
                	'width' => $split[0],
                	'height' => $split[1],
                	'image_using' => []
                ])
                @endif
        	@endif
        	
        	@if($value['type'] == 'select')
        		<div class="form-group">
                  <label for="exampleInputEmail1">{{ $value['text'] }}</label>
                  <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                    <option value="">{{ $value['empty_text'] }}</option>
                  	{!! Utils::createSelectList($value['table']) !!}
                  </select>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'editor')
        		<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                  <label for="exampleInputPassword1">{{ $value['text'] }}</label>
                  <textarea name="{{ $key }}" id="editor_{{ $key }}" class="ckeditor" placeholder="Place some text here">{{ old($key) }}</textarea>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'datepicker')
        		<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                  <label for="exampleInputEmail1">{{ $value['text'] }}</label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key) }}" placeholder="{{ $value['text'] }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'timepicker')
        		<div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>{{ $value['text'] }}</label>
                      <input type="text" name="{{ $key }}" id="{{ $key }}" value="{{ old($key) }}" class="form-control timepicker">
                    </div>
                  </div>
        	@endif
        	
        	@if($value['type'] == 'checkbox')
        		<div class="checkbox">
                  <label>
                    <input type="checkbox" name="{{ $key }}" value="1" @if(old($key, true)) {{ 'checked="checked"' }} @endif> {{ $value['text'] }}
                  </label>
                </div>
        	@endif
        @else
        	<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
              <label for="exampleInputEmail1">{{ $value }}</label>
              <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key) }}" placeholder="{{ $value }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
              <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
            </div>
        @endif
        @endforeach
    </div>
</div>