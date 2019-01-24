<div class="form-group @if ($errors->has('logo')){{'has-error'}} @endif">
  <label for="exampleInputFile">{{ $text }}</label>
  <input type="file" class="form-control" name="{{ $name }}" id="{{ $name }}">
  <p class="help-block">{{ Utils::replaceMessageParam($text_small,[$size]) }}</p>
  <span class="help-block">@if ($errors->has('logo')){{ $errors->first('logo') }}@endif</span>
</div>