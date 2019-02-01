<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ isset($forms['text']) ? $forms['text'] : trans('auth.edit_box_title') }}</h3>
    </div>
    {{ csrf_field() }}
    <div class="box-body">
        <input type="hidden" name="id" id="id" value="{{ $data->id }}" />
        @foreach($forms as $key=>$value)
        @if($key == 'text')
        	@continue;
        @endif
        @if(is_array($value))
        	@if($value['type'] == 'textarea')
        		<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                  <label for="exampleInputPassword1">{{ $value['text'] }}</label>
                  <textarea class="form-control" rows="6" name="{{ $key }}" placeholder="{{ $value['text'] }}" maxlength="{{ Common::DESC_MAXLENGTH }}">{{ old($key, $data->$key) }}</textarea>
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
        		@if($key != 'image' && $key != 'attachment')
            		@include('auth.common.upload',[
                    	'text' => $value['text'],
                    	'text_small' => isset($value['note_text']) ? $value['note_text'] : trans('auth.text_image_small'),
                    	'errors' => $errors,
                    	'name' => $key,
                    	'size' => $size,
                    	'width' => $split[0],
                    	'height' => $split[1],
                    	'image_using' => Utils::getImageLink($data->$key)
                    ])
                @else
                	@include('auth.common.upload_product',[
                    	'text' => $value['text'],
                    	'text_small' => isset($value['note_text']) ? $value['note_text'] : trans('auth.text_image_small'),
                    	'errors' => $errors,
                    	'name' => $key,
                    	'size' => $size,
                    	'width' => $split[0],
                    	'height' => $split[1],
                    	'image_using' => $key == 'image' ? $data->getAllImage($data->id) : []
                    ])
                @endif
        	@endif
        	
        	@if($value['type'] == 'checkbox')
        		<div class="checkbox">
                  <label>
                    <input type="checkbox" name="{{ $key }}" value="1" @if(old($key, $data->$key)) {{ 'checked="checked"' }} @endif> {{ $value['text'] }}
                  </label>
                </div>
        	@endif
        	
        	@if($value['type'] == 'select')
        		<div class="form-group">
                  <label for="exampleInputEmail1">{{ $value['text'] }}</label>
                  <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                    <option value="0">{{ $value['empty_text'] }}</option>
                  	{!! Utils::createSelectList($value['table'], $data->$key) !!}
                  </select>
                </div>
        	@endif
        	
        	@if($value['type'] == 'editor')
        		<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                  <label for="exampleInputPassword1">{{ $value['text'] }}</label>
                  <textarea name="{{ $key }}" id="editor1_{{ $key }}" class="ckeditor" placeholder="Place some text here" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>{{ old($key, $data->$key) }}</textarea>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'datepicker')
        		<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                  <label for="exampleInputEmail1">{{ $value['text'] }}</label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, date('d-m-Y', strtotime($data->$key))) }}" placeholder="{{ $value['text'] }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'timepicker')
        		<div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>{{ $value['text'] }}</label>
                      <input type="text" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, date('h:i A', strtotime($data->$key))) }}" class="form-control timepicker">
                    </div>
                  </div>
        	@endif
        	
        	@if($value['type'] == 'password')
        		<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                  <label for="exampleInputEmail1">{{ $value['text'] }}</label>
                  <input type="password" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, '') }}" placeholder="{{ $value['text'] }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
            @if($value['type'] == 'text')
        		<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
                  <label for="exampleInputEmail1">{{ $value['text'] }}</label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $data->$key) }}" placeholder="{{ $value['text'] }}" maxlength="{{ Common::NAME_MAXLENGTH }}" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
        @else
        	<div class="form-group @if ($errors->has($key)){{'has-error'}} @endif">
              <label for="exampleInputEmail1">{{ $value }}</label>
              <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $data->$key) }}" placeholder="{{ $value }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
              <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
            </div>
        @endif
        @endforeach
    </div>
</div>