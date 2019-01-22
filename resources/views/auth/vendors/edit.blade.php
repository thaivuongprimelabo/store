@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.vendor.create_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_vendor') }}">{{ trans('auth.sidebar.vendor') }}</a></li>
    <li class="active">{{ trans('auth.vendor.create_title') }}</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('auth.create_box_title') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('auth_vendor_edit', ['id' => $vendor->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                  	<input type="hidden" name="id" value="{{ $vendor->id }}" />
                    <div class="form-group @if ($errors->has('name')){{'has-error'}} @endif">
                      <label for="exampleInputEmail1">{{ trans('auth.vendor.form.name') }}</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $vendor->name) }}" placeholder="{{ trans('auth.vendor.form.name') }}">
                      @if ($errors->has('name'))<span class="help-block">{{ $errors->first('name') }}</span>@endif
                    </div>
                    <div class="form-group @if ($errors->has('description')){{'has-error'}} @endif">
                      <label for="exampleInputPassword1">{{ trans('auth.vendor.form.description') }}</label>
                      <textarea class="form-control" rows="6" name="description" placeholder="{{ trans('auth.vendor.form.description') }}">{{ old('description', $vendor->description) }}</textarea>
                      @if ($errors->has('description'))<span class="help-block">{{ $errors->first('description') }}</span>@endif
                    </div>
                    <div class="form-group @if ($errors->has('logo')){{'has-error'}} @endif">
                      <label for="exampleInputFile">{{ trans('auth.vendor.form.logo') }}</label>
                      <input type="file" name="logo" id="logo">
                      <p class="help-block">{{ trans('auth.vendor.form.logo_text') }}</p>
                      @if ($errors->has('logo'))<span class="help-block">{{ $errors->first('logo') }}</span>@endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Hình hiện tại</label>
                      <img class="img img-responsive" alt="" src="{{ Utils::getImageLink($vendor->logo) }}" width="150" height="120" />
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" value="1" @if(old('status', $vendor->status)) {{ 'checked="checked"' }} @endif> {{ trans('auth.status.active') }}
                      </label>
                    </div>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                  	<button type="button" class="btn btn-default" onclick="window.location='{{ route('auth_vendor') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('auth.button.back') }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
                  </div>
                </form>
            </div>
            <!-- /.box -->
		</div>
	</div>
</section>
@endsection