@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ trans('auth.' . $name . '.list_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">{{ trans('auth.' . $name . '.list_title') }}</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-xs-12">
          @include('auth.common.search')
          <div class="box">
            <div class="box-header">
              <div class="col-md-12">
                  <div class="col-md-4">
                  	<h3 class="box-title">{{ trans('auth.' . $name . '.list_title') }}</h3>
                  </div>
                  <div class="col-md-8">
                  	<button type="button" id="remove_many" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Xóa</button>
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div id="ajax_list">
                @include('auth.ajax_list')
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@endsection