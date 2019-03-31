{{ csrf_field() }}
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('auth.' . $name . '.edit_title') }}</h3>
    </div>
    <div class="box-body">
        <input type="hidden" name="id" id="id_check" value="{{ $data->id }}" />
        @php
        	if(!isset($form)) {
    			$form = trans('auth.' . $name . '.form');
    		}
    	@endphp
        {!! Utils::generateForm($form, $config, $name, $data) !!}
    </div>
    @if(!isset($hide_footer))
    @include('auth.common.button_footer',['back_url' => route('auth_' . $name)])
    @endif
</div>