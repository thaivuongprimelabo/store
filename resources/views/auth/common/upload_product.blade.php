@php
   $control_name = $name . '[]';
   $control_id = $name;
@endphp
@if($multiple)
<div class="form-group {{ $containerId }}">
  <label for="exampleInputFile">{{ $text }}</label>&nbsp;&nbsp;({{ Utils::replaceMessageParam($text_small,[$size]) }})<br/>
  <div id="preview_list">
  	@if(count($image_using))
  		@foreach($image_using as $id=>$image)
  		<div class="image_product" style="display: inline-block;">
          <a href="javascript:void(0)" class="upload_image" style="width: {{ $width }}px; height: {{ $height }}px">
          	<img src="{{ $image }}" style="width:{{ $width }}px; height:{{ $height }}px" />
          </a>
          <a href="javascript:void(0)" class="remove" data-id="{{ $id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
          <input type="hidden" name="image_ids[]" class="upload_image_id" value="{{ $id }}" />
          <input type="hidden" class="demension" value="{{ $config[$name . '_image_size'] }}" />
          <input type="hidden" class="upload_limit" value="{{ $config[$name . '_maximum_upload'] }}" />
      	</div>
  		@endforeach
  	@endif
  	<div id="{{ $name }}_0" class="image_product" style="display: inline-block;">
      <a href="javascript:void(0)" class="add_image" style="width: {{ $width }}px; height: {{ $height }}px">
      	<i class="fa fa-plus-circle" aria-hidden="true"></i><br/>{{ trans('auth.button.add_image') }}
      </a>
  	</div>
  </div>
</div>
<input type="hidden" id="upload_index" value="-1" />
<input type="hidden" name="image_del_ids" value="" />
@else
<div class="form-group {{ $containerId }}">
  <label for="exampleInputFile">{{ $text }}</label>&nbsp;&nbsp;({{ Utils::replaceMessageParam($text_small,[$size]) }})<br/>
  <div id="preview_list">
  	
  		<div id="{{ $name }}_0" class="image_product" style="display: inline-block;">
          <a href="javascript:void(0)" class="upload_image open_upload_dialog" style="width: {{ $width }}px; height: {{ $height }}px">
          	@if($image_using)
          	<img src="{{ Utils::getImageLink($image_using) }}" style="width:{{ $width }}px; height:{{ $height }}px" />
          	@else
          	<i class="fa fa-upload" aria-hidden="true"></i><br/>{{ trans('auth.button.upload_image') }}
          	@endif
          </a>
          <input type="file" name="image_upload[]" class="upload_image_product" style="display: none" />
          <input type="hidden" name="image_upload_url[]" class="upload_image_product_url" />
          <input type="hidden" name="image_ids[]" class="upload_image_id" value="9999" />
          <input type="hidden" class="demension" value="{{ $config[$name . '_image_size'] }}" />
          <input type="hidden" class="upload_limit" value="{{ $config[$name . '_maximum_upload'] }}" />
      	</div>
  </div>
</div>
@endif
