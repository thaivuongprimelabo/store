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
              	 @include('auth.common.search',['form' => trans('auth.banners.search_form')])
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