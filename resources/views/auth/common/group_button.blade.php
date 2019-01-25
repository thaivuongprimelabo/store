<div class="col-md-12 nopadding">
    <div class="col-md-6">
    	<div class="btn-group">
        	<button type="button" id="create" class="btn btn-warning pull-left" onclick="window.location='{{ route('auth_categories_create') }}'">{{ trans('auth.button.create') }}</button>
        	@if(isset($page))
        	<button type="button" id="remove_all" class="btn btn-danger pull-left" onclick="window.location='{{ route('auth_categories_remove') }}'">{{ trans('auth.button.remove') }}</button>
     		@endif
     	</div>
     </div>
 	 <div class="col-md-6">
    	<button type="button" id="search" class="btn btn-primary pull-right" data-url="{{ route('auth_categories_search') }}">{{ trans('auth.button.search') }}</button>
  	 </div>
</div>