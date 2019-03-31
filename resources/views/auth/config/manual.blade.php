@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.manual.title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_config_edit') }}">{{ trans('auth.sidebar.config_edit') }}</a></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
                <div class="box-body">
                	<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
                	    {{ csrf_field() }}
                		@include('auth.common.alert')
                		@if(Auth::user()->role_id == Common::SUPER_ADMIN)
    					<div class="form-group ">
                      		<textarea name="manual" class="ckeditor">{{ $manual }}</textarea>
                    	</div>
                    	<div class="box-footer">
                            <button type="submit" id="save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
                        </div>
                        @else
                        {!! $manual !!}
                        @endif
                    </form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection