@php
   $control_name = $name;
   $control_id = $name;
   $display = 'display:none';
@endphp
<div class="form-group @if ($errors->has($name)){{'has-error'}} @endif">
  <label for="exampleInputFile">{{ $text }}</label>
  <input type="file" class="form-control" name="{{ $control_name }}" id="{{ $control_id }}" />
  <p class="help-block">{{ Utils::replaceMessageParam($text_small,[$size]) }}</p>
  <span class="help-block">@if ($errors->has($name)){{ $errors->first($name) }}@endif</span>
</div>
@if($name != 'attachment')
<div class="form-group">
  <label for="exampleInputFile">{{ trans('auth.preview_image') }}</label>&nbsp;&nbsp;
  <br/>
  <div id="preview_list">
  	@if(count($image_using))
  	@foreach($image_using as $image)
  	<a href="javascript:void(0)" target="_blank"><img class="img-thumbnail thumb" alt="" src="{{ $image }}" data-holder-rendered="true" style="width: {{ $width }}px; height: {{ $height }}px"></a>
  	@endforeach
  	@endif
  </div>
</div>
@endif