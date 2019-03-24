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
          <a href="javascript:void(0)" class="remove" data-id="{{ $id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
      	</div>
  		@endforeach
  	@endif
  	<div class="image_product" style="display: inline-block;">
      <a href="javascript:void(0)" class="add_image" style="width: {{ $width }}px; height: {{ $height }}px">
      	<i class="fa fa-plus-circle" aria-hidden="true"></i><br/>{{ trans('auth.button.add_image') }}
      </a>
  	</div>
  </div>
  
</div>
<input type="hidden" id="upload_index" value="-1" />
<input type="hidden" name="image_del_ids" value="" />
