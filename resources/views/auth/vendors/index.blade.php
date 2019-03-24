@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ trans('auth.sidebar.products.vendors') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">{{ trans('auth.sidebar.products.vendors') }}</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
              <!-- Box Body -->
              <div class="box-body">
              	 <form id="search_form">
                  	 <div class="col-md-3">
                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" name="id_search" id="id_search" placeholder="{{ trans('auth.vendors.id_search_placeholder') }}"/>
                          <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" name="name_search" id="name_search" placeholder="{{ trans('auth.vendors.name_search_placeholder') }}"/>
                          <span class="glyphicon glyphicon-search form-control-feedback"></span>	
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                          <select class="form-control" name="status_search" id="status_search">
                          	<option value="">{{ trans('auth.vendors.status_search') }}</option>
                          	{!! Status::createSelectList() !!}
                          </select>
                        </div>
                     </div>
                 </form>
                 <div class="col-md-6">
                    <button type="button" id="create" class="btn btn-warning pull-left" onclick="window.location='{{ route('auth_vendors_create') }}'">{{ trans('auth.button.create') }}</button>
                  </div>
                 <div class="col-md-6">
                    <button type="button" id="search" class="btn btn-primary pull-right" data-url="{{ route('auth_vendors_search') }}">{{ trans('auth.button.search') }}</button>
                  </div>
              </div>
          </div>
          @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('auth.vendors.list_title') }}</h3>
            </div>
            <!-- /.box-header -->
            <div id="ajax_list">
            @include('auth.vendors.ajax_list')
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@endsection