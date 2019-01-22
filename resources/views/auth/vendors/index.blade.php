@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ trans('auth.sidebar.vendor') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">{{ trans('auth.sidebar.vendor') }}</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
              <!-- Box Body -->
              <div class="box-body">
              	 <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control" name="id_search" id="id_search" placeholder="{{ trans('auth.vendor.id_search_placeholder') }}"/>
                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" name="name_search" id="name_search" placeholder="{{ trans('auth.vendor.name_search_placeholder') }}"/>
                    </div>
                 </div>
                 <div class="col-md-3">
                    <div class="form-group">
                      <select class="form-control" name="status" id="status_search">
                      	<option value="">{{ trans('auth.vendor.status_search') }}</option>
                      	@php
                      		$statusList = Status::getData();
                      	@endphp
                      	@foreach($statusList as $key=>$value)
                      	<option value="{{ $key }}">{{ $value }}</option>
                      	@endforeach
                      </select>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <button type="button" id="search" class="btn btn-warning pull-left" onclick="window.location='{{ route('auth_vendor_create') }}'">{{ trans('auth.button.create') }}</button>
                  </div>
                 <div class="col-md-6">
                    <button type="button" id="search" class="btn btn-primary pull-right">{{ trans('auth.button.search') }}</button>
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
              <h3 class="box-title">{{ trans('auth.vendor.list_title') }}</h3>
            </div>
            <!-- /.box-header -->
            <div id="vendor_list">
            @include('auth.vendors.ajax_list')
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@endsection