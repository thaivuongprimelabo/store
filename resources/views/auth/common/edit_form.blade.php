<div class="box box-primary">
	@if(isset($forms['text']))
    <div class="box-header with-border">
      <h3 class="box-title">{{ $forms['text'] }}</h3>
    </div>
    @endif
    {{ csrf_field() }}
    <div class="box-body">
        <input type="hidden" name="id" id="id_check" value="{{ $data->id }}" />
        @foreach($forms as $key=>$value)
        @if($key == 'text')
        	@continue;
        @endif
        @if(is_array($value))
        	@php
        		$text = $value['text'];
        		$placeholder = isset($value['placeholder']) ? $value['placeholder'] : $text;
        		$defaultValue = isset($value['value']) ? $value['value'] : '';
        	@endphp
        	@if($value['type'] == 'textarea')
        		<div class="form-group ">
                  <label for="exampleInputPassword1">{{ $text }}</label>
                  <textarea class="form-control" rows="6" name="{{ $key }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::DESC_MAXLENGTH }}" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>{{ old($key, $data->$key) }}</textarea>
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
                	'text_small' => isset($value['note_text']) ? $value['note_text'] : trans('auth.text_image_small'),
                	'errors' => $errors,
                	'name' => $key,
                	'size' => $size,
                	'width' => $split[0],
                	'height' => $split[1],
                	'image_using' => isset($value['multiple']) ? $data->getAllImage($data->id) : $data->$key,
                	'multiple' => isset($value['multiple']) ? true : false
                ])
        	@endif
        	
        	@if($value['type'] == 'file_simple')
        		<div class="form-group">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <input type="file" name="{{ $key }}" class="form-control" />
                </div>
        	@endif
        	
        	@if($value['type'] == 'checkbox')
        		<div class="checkbox">
                  <label>
                    <input type="checkbox" name="{{ $key }}" value="1" @if(old($key, $data->$key)) {{ 'checked="checked"' }} @endif> {{ $text }}
                  </label>
                </div>
        	@endif
        	
        	@if($value['type'] == 'select')
        		<div class="form-group">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                  	@if(isset($value['empty_text']))
                    <option value="0">{{ $value['empty_text'] }}</option>
                    @endif
                  	{!! Utils::createSelectList($value['table'], $data->$key) !!}
                  </select>
                </div>
        	@endif
        	
        	@if($value['type'] == 'editor')
        		<div class="form-group ">
                  <label for="exampleInputPassword1">{{ $text }}</label>
                  <textarea name="{{ $key }}" id="editor1_{{ $key }}" class="ckeditor" placeholder="{{ $placeholder }}" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>{{ old($key, $data->$key) }}</textarea>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'datepicker')
        		<div class="form-group ">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, date('d-m-Y', strtotime($data->$key))) }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'timepicker')
        		<div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>{{ $text }}</label>
                      <input type="text" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, date('h:i A', strtotime($data->$key))) }}" class="form-control timepicker">
                    </div>
                  </div>
        	@endif
        	
        	@if($value['type'] == 'password')
        		<div class="form-group ">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <input type="password" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, '') }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
            @if($value['type'] == 'text')
        		<div class="form-group ">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $data->$key) }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::NAME_MAXLENGTH }}" {{ (isset($value['disabled']) || $key == 'email') ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
             @if($value['type'] == 'link')
        		<div class="form-group ">
                  <label for="exampleInputEmail1">{{ $text }}</label><br/>
                  <a href="mailto:{{ $data->$key }}">{{ $data->$key }}</a>
                </div>
            @endif
            
            @if($value['type'] == 'checkbox_multi')
        		<div class="form-group">
        			<label>{{ $text }}</label>
            		<div class="checkbox">
                      <label>
                        {!! Utils::createCheckboxList($value['table'], $data->$key) !!}
                      </label>
                    </div>
                </div>
        	@endif
        	
        	@if($value['type'] == 'checkbox_color_multi')
        		<div class="form-group">
        			<label>{{ $text }}</label>
            		<div class="checkbox">
                      <label>
                        {!! Utils::createCheckboxList($value['table'], $data->$key) !!}
                      </label>
                    </div>
                </div>
        	@endif
        	@if($value['type'] == 'label')
        		<div class="form-group">
                  <label>{{ $text }}</label>
                  <span>{{ $data->$key }}</span>
                </div>
        	@endif
        	
        	@if($value['type'] == 'select_status_order')
        		<div class="form-group">
                  <label for="exampleInputEmail1">{{ $text }}</label>
                  <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                  	{!! Status::createSelectList(1, $data->$key) !!}
                  </select>
                </div>
        	@endif
        @else
        	<div class="form-group ">
              <label for="exampleInputEmail1">{{ $value }}</label>
              <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $data->$key) }}" placeholder="{{ $value }}" maxlength="{{ Common::NAME_MAXLENGTH }}" {{ $key == 'email' ? 'disabled' : '' }}>
              <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
            </div>
        @endif
        @endforeach
    </div>
</div>