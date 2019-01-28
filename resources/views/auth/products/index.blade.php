@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ trans('auth.sidebar.products') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">{{ trans('auth.sidebar.products') }}</li>
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
                  	 <div class="col-md-2">
                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" name="id_search" id="id_search" placeholder="{{ trans('auth.products.id_search_placeholder') }}"/>
                          <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" name="name_search" id="name_search" placeholder="{{ trans('auth.products.name_search_placeholder') }}"/>
                          <span class="glyphicon glyphicon-search form-control-feedback"></span>	
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                          <select class="form-control" name="category_search" id="status_search">
                          	<option value="">{{ trans('auth.products.category_search') }}</option>
                          	{!! Utils::createSelectList(Common::CATEGORIES) !!}
                          </select>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                          <select class="form-control" name="vendor_search" id="status_search">
                          	<option value="">{{ trans('auth.products.vendor_search') }}</option>
                          	{!! Utils::createSelectList(Common::VENDORS) !!}
                          </select>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                          <select class="form-control" name="status_search" id="status_search">
                          	<option value="">{{ trans('auth.products.status_search') }}</option>
                          	{!! Status::createSelectList() !!}
                          </select>
                        </div>
                     </div>
                 </form>
                 @include('auth.common.group_button')
              </div>
          </div>
          @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('auth.products.list_title') }}</h3>
            </div>
            <!-- /.box-header -->
            <div id="ajax_list">
            @include('auth.products.ajax_list')
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@endsection