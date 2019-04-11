@php
	$id = isset($name) && $name == 'users' ? 'save_user' : 'save';
@endphp
<div class="box-footer">
	@if($name != 'config')
  	<button type="button" class="btn btn-default" onclick="window.location='{{ $back_url }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
    @endif
    <button type="button" id="{{ $id }}" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
    @if(Auth::user()->role_id == UserRole::SUPER_ADMIN && $name == 'config')
    <button type="submit" name="clear_data" class="btn btn-danger" value="1"><i class="fa fa-refresh" aria-hidden="true"></i> {{ trans('auth.button.remove_all_data') }}</button>
    <button type="submit" name="clear_config_cache" class="btn btn-danger" value="1"><i class="fa fa-refresh" aria-hidden="true"></i> {{ trans('auth.button.clear_config_cache') }}</button>
	@endif
</div>