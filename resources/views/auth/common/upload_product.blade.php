@php
   $control_name = $name . '[]';
   $control_id = $name;
@endphp
<div class="form-group @if ($errors->has($name)){{'has-error'}} @endif">
  <label for="exampleInputFile">{{ $text }}</label><br/>
  <div id="preview_list">
  	<div class="image_product" style="display: inline-block;">
      <a href="javascript:void(0)" class="upload_image" style="width: {{ $width }}px; height: {{ $height }}px">
      	<i class="fa fa-upload" aria-hidden="true"></i><br/>Tải hình
      </a>
      <input type="file" name="image[]" class="upload_image_product" style="display: none" />
  	</div>
  	<div class="image_product" style="display: inline-block;">
      <a href="javascript:void(0)" class="add_image" style="width: {{ $width }}px; height: {{ $height }}px">
      	<i class="fa fa-plus-circle" aria-hidden="true"></i><br/>Thêm hình
      </a>
  	</div>
  </div>
</div>

<div class="image_product_clone" style="display: none;">
  <a href="javascript:void(0)" class="upload_image" style="width: {{ $width }}px; height: {{ $height }}px">
  	<i class="fa fa-upload" aria-hidden="true"></i><br/>Tải hình
  </a>
  <input type="file" name="image[]" class="upload_image_product" style="display: none" />
</div>
