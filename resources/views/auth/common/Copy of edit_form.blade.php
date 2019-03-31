<div class="box box-primary">
	@if(isset($forms['text']))
    <div class="box-header with-border">
      <h3 class="box-title">{{ $forms['text'] }}</h3>
    </div>
    @endif
    {{ csrf_field() }}
    <div class="box-body">
        <input type="hidden" name="id" id="id_check" value="{{ $data->id }}" />
        {!! Utils::generateForm($forms, $config, $data) !!}
        @php
    		$containerShow = '';
    	@endphp
        @foreach($forms as $key=>$value)
        @if($key == 'text')
        	@continue;
        @endif
        @if(is_array($value))
        	@php
        		$text = isset($value['text']) ? $value['text'] : '';
        		$placeholder = isset($value['placeholder']) ? $value['placeholder'] : $text;
        		$defaultValue = isset($value['value']) ? $value['value'] : '';
        		$maxlength = isset($value['maxlength']) ? $value['maxlength'] : 120;
        		$lengthText = str_replace('{0}', $maxlength, trans('auth.length_text'));
        		$containerId = '';
        		if(isset($value['container_id'])) {
        			$container_id = isset($value['container_id']) ? $value['container_id'] : '';
            		if(!empty($containerShow) && $containerShow != $container_id) {
            			$containerId = 'select_type ' . $container_id . ' hide_element';
            		} else {
            			$containerId = 'select_type ' . $container_id;
            		}
        		}
        	@endphp
        	
        	@if($value['type'] == 'radio_list')
        		@php
        			$radio_values = $value['value'];
        		@endphp
        		<div class="radio">
        			@foreach($radio_values as $k=>$v)
        			@php
        				if($k == $data->$key) {
        					$containerShow = $k;
        				}
        			@endphp
                  	<label>
                    	<input type="radio" class="{{ $key }}" name="{{ $key }}" value="{{ $k }}" {{ $k == $data->$key ? 'checked="checked"' : '' }} /> {{ $v['text'] }}
                  	</label>
                  	@endforeach
                </div>
        	@endif
        	
        	@if($value['type'] == 'youtube_preview')
        		<div class="form-group {{ $containerId }}">
                  <label for="exampleInputPassword1">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <div id="youtube_preview">
                  	@if(!Utils::blank($data->youtube_id))
                  	<iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $data->youtube_id }}" frameborder="0" allowfullscreen></iframe>
                  	@endif	
                  </div>
                  <input type="hidden" name="youtube_embed_url" id="youtube_embed_url" value="{{ $data->youtube_id }}" />
                </div>
        	@endif
        	
        	@if($value['type'] == 'youtube_url')
            	@php
            		$youtube_url = !Utils::blank($data->$key) ? 'https://www.youtube.com/watch?v=' . $data->$key : '';
            	@endphp
        		<div class="form-group {{ $containerId }}">
                  <label for="">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $youtube_url) }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::NAME_MAXLENGTH }}" {{ (isset($value['disabled'])) ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
        	
        	@if($value['type'] == 'textarea')
        		<div class="form-group ">
                  <label for="exampleInputPassword1">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <textarea class="form-control" rows="6" name="{{ $key }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>{{ old($key, $data->$key) }}</textarea>
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
                	'multiple' => isset($value['multiple']) ? true : false,
                	'containter_id' =>  $containerId
                ])
        	@endif
        	
        	@if($value['type'] == 'file_simple')
        		<div class="form-group">
                  <label for="">{{ $text }}</label>
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
                  <label for="">{{ $text }}</label>
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
                  <label for="">{{ $text }}</label>
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
                  <label for="">{{ $text }}</label>
                  <input type="password" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, '') }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::NAME_MAXLENGTH }}">
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
            @if($value['type'] == 'text')
        		<div class="form-group {{ $containerId }}">
                  <label for="">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $data->$key) }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::NAME_MAXLENGTH }}" {{ (isset($value['disabled'])) ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
            @if($value['type'] == 'currency')
        		<div class="form-group {{ $containerId }}">
                  <label for="">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $data->$key) }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::NAME_MAXLENGTH }}" {{ (isset($value['disabled'])) ? 'disabled=true' : '' }}>
                  <span id="format_currency"><strong><small>Định dạng tiền tệ: <i>0</i></small></strong></span>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
            @if($value['type'] == 'number')
        		<div class="form-group ">
                  <label for="">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <input type="number" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $data->$key) }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}" {{ isset($value['disabled']) ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
            @if($value['type'] == 'email')
        		<div class="form-group ">
                  <label for="">{{ $text }}<small>{{ $lengthText }}</small></label>
                  <input type="email" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ old($key, $data->$key) }}" placeholder="{{ $placeholder }}" maxlength="{{ Common::NAME_MAXLENGTH }}" {{ (isset($value['disabled'])) ? 'disabled=true' : '' }}>
                  <span class="help-block">@if ($errors->has($key)){{ $errors->first($key) }}@endif</span>
                </div>
            @endif
            
             @if($value['type'] == 'link')
        		<div class="form-group ">
                  <label for="">{{ $text }}</label><br/>
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
                  <label for="">{{ $text }}</label>
                  <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                  	{!! Status::createSelectList(1, $data->$key) !!}
                  </select>
                </div>
        	@endif
        @endif
        @endforeach
    </div>
</div>