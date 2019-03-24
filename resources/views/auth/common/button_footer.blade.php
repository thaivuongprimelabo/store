@php
	$id = isset($id) ? $id : 'save';
@endphp
<div class="box-footer">
  	<button type="button" class="btn btn-default" onclick="window.location='{{ $back_url }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
    <button type="button" id="{{ $id }}" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
</div>