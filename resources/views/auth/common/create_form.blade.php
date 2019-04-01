{{ csrf_field() }}
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('auth.' . $name . '.create_title') }}</h3>
    </div>
    <div class="box-body">
    	@php
    		$forms = trans('auth.' . $name . '.form');
    	@endphp
    	@if(!isset($tab))
    	{!! Utils::generateForm($forms, $config, $name) !!}
    	@else
    	<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab-form-1" data-toggle="tab" aria-expanded="true"> {{ trans('auth.product_info') }}
					</a>
				</li>
				<li>
					<a href="#tab-form-2" data-toggle="tab"> {{ trans('auth.services') }}
					</a>
				</li>
			</ul>
			<div class="tab-content fields-group">
				<div class="tab-pane active" id="tab-form-1">
					{!! Utils::generateForm($forms, $config, $name) !!}
				</div>
				<div class="tab-pane" id="tab-form-2">
					<div class="btn-group mb-1">
						<button id="add_new_service" type="button" class="btn btn-sm btn-success" title="Add new services"><i class="fa fa-plus"></i> {{ trans('auth.button.add_service') }}</button>
					</div>
					<div id="services" class="form-group">
						
					</div>
					
				</div>
			</div>
		</div>
    	@endif
    </div>
    @if(!isset($hide_footer))
    @include('auth.common.button_footer',['back_url' => route('auth_' . $name)])
    @endif
</div>