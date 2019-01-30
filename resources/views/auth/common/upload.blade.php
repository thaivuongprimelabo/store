<div class="form-group @if ($errors->has($name)){{'has-error'}} @endif">
  <label for="exampleInputFile">{{ $text }}</label><br/>
  <div id="preview_list">
  	@if($image_using != '')
  		<div class="image_product" style="display: inline-block;">
          <a href="javascript:void(0)" class="upload_image" style="width: {{ $width }}px; height: {{ $height }}px">
          	<img src="{{ $image_using }}" style="width:{{ $width }}px; height:{{ $height }}px" />
          </a>
          <input type="file" name="{{ $name }}" id="{{ $name }}" style="display: none" />
      	</div>
  	@else
  		<div class="image_product" style="display: inline-block;">
          <a href="javascript:void(0)" class="upload_image" style="width: {{ $width }}px; height: {{ $height }}px">
          	<i class="fa fa-upload" aria-hidden="true"></i><br/>{{ trans('auth.button.upload_image') }}
          </a>
          <input type="file" name="{{ $name }}" id="{{ $name }}" style="display: none" />
      	</div>
  	@endif
  </div>
  <p class="help-block">{{ Utils::replaceMessageParam($text_small,[$size]) }}</p>
  <span class="help-block">@if ($errors->has($name)){{ $errors->first($name) }}@endif</span>
</div>
