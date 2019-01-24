@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ trans('auth.sidebar.banners') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">{{ trans('auth.sidebar.banners') }}</li>
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
                        <div class="form-group">
                          <select class="form-control" name="status_search" id="status_search">
                          	<option value="">{{ trans('auth.banners.status_search') }}</option>
                          	@php
                          		$statusList = Status::getData();
                          	@endphp
                          	@foreach($statusList as $key=>$value)
                          	<option value="{{ $key }}">{{ $value }}</option>
                          	@endforeach
                          </select>
                        </div>
                     </div>
                 </form>
                 <div class="col-md-1">
                    <button type="button" id="search" class="btn btn-primary pull-right" data-url="{{ route('auth_banners_search') }}">{{ trans('auth.button.search') }}</button>
                  </div>
                  <div class="col-md-1">
                    <button type="button" id="search" class="btn btn-warning pull-left" onclick="window.location='{{ route('auth_banners_create') }}'">{{ trans('auth.button.create') }}</button>
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
              <h3 class="box-title">{{ trans('auth.banners.list_title') }}</h3>
            </div>
            <!-- /.box-header -->
            <div id="ajax_list">
            @include('auth.banners.ajax_list')
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@endsection