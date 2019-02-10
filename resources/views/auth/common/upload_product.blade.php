@php
   $control_name = $name . '[]';
   $control_id = $name;
@endphp
<div class="form-group">
  <label for="exampleInputFile">{{ $text }}</label>&nbsp;&nbsp;({{ Utils::replaceMessageParam($text_small,[$size]) }})<br/>
  <div id="preview_list">
  	@if(count($image_using))
  		@foreach($image_using as $id=>$image)
  		<div class="image_product" style="display: inline-block;">
          <a href="javascript:void(0)" class="upload_image" style="width: {{ $width }}px; height: {{ $height }}px">
          	<img src="{{ $image }}" style="width:{{ $width }}px; height:{{ $height }}px" />
          </a>
          <input type="file" name="image_upload[]" class="upload_image_product" style="display: none" />
          <input type="hidden" name="image_ids[]" value="{{ $id }}" style="display: none" />
          <a href="javascript:void(0)" class="remove"><i class="fa fa-trash" aria-hidden="true"></i></a>
      	</div>
  		@endforeach
  	@else
  		<div class="image_product" style="display: inline-block;">
          <a href="javascript:void(0)" class="upload_image" style="width: {{ $width }}px; height: {{ $height }}px">
          	<i class="fa fa-upload" aria-hidden="true"></i><br/>{{ trans('auth.button.upload_image') }}
          </a>
          <input type="file" name="image_upload[]" class="upload_image_product" style="display: none" />
      	</div>
  	@endif
  	<div class="image_product" style="display: inline-block;">
      <a href="javascript:void(0)" class="add_image" style="width: {{ $width }}px; height: {{ $height }}px">
      	<i class="fa fa-plus-circle" aria-hidden="true"></i><br/>{{ trans('auth.button.add_image') }}
      </a>
  	</div>
  </div>
  
  <div id="error_list">
  
  </div>
</div>
<div class="image_product_clone" style="display: none;">
  <a href="javascript:void(0)" class="upload_image" style="width: {{ $width }}px; height: {{ $height }}px">
  	<i class="fa fa-upload" aria-hidden="true"></i><br/>Tải hình
  </a>
  <input type="file" name="image_upload[]" class="upload_image_product" style="display: none" />
  <input type="hidden" name="image_ids[]" value="9999" style="display: none" />
</div>
