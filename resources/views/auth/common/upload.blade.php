<div class="form-group @if ($errors->has($name)){{'has-error'}} @endif">
  <label for="exampleInputFile">{{ $text }}</label>
  <input type="file" class="form-control" name="{{ $name }}" id="{{ $name }}">
  <p class="help-block">{{ Utils::replaceMessageParam($text_small,[$size]) }}</p>
  <span class="help-block">@if ($errors->has($name)){{ $errors->first($name) }}@endif</span>
</div>
@if($name != 'attachment')
<div class="form-group">
  <label for="exampleInputFile">{{ trans('auth.preview_image') }}</label>
  <img id="preview" class="img img-responsive" alt="{{ $image_using }}" src="{{ $image_using }}" data-holder-rendered="true" style="width: {{ $width }}px;">
</div>
@endif