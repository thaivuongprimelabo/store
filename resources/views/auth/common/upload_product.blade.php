@php
   $control_name = $name;
   $control_id = $name;
   $multiple = '';
   $display = 'display:none';
   if($name == 'image') {
   		$control_name = $control_name . '[]';
   		$multiple = 'multiple';
   }
@endphp
<div class="form-group @if ($errors->has($name)){{'has-error'}} @endif">
  <label for="exampleInputFile">{{ $text }}</label>
  <input type="file" class="form-control" name="{{ $control_name }}" id="{{ $control_id }}" multiple>
  <p class="help-block">{{ Utils::replaceMessageParam($text_small,[$size]) }}</p>
  <span class="help-block">@if ($errors->has($name)){{ $errors->first($name) }}@endif</span>
</div>
<div class="form-group">
  <label for="exampleInputFile">{{ trans('auth.preview_image') }}</label>&nbsp;&nbsp;
  <a id="remove_image" href="javascript:void(0)" style="{{ $display }}" ><i class="fa fa-trash" aria-hidden="true" style="font-size: 24px"></i>Xóa hình</a>
  <br/>
  <div id="preview_list">
  	@if(count($image_using))
  	@foreach($image_using as $image)
  	<a href="javascript:void(0)" target="_blank"><img class="img-thumbnail thumb" alt="" src="{{ $image }}" data-holder-rendered="true" style="width: {{ $width }}px; height: {{ $height }}px"></a>
  	@endforeach
  	@endif
  </div>
  <input type="hidden" name="file_hidden_id" id="file_hidden_id" />
</div>
