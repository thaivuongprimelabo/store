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
          <div class="box">
              <!-- Box Body -->
              <div class="box-body">
              	 @include('auth.common.search',['form' => trans('auth.' . $name . '.search_form')])
              </div>
          </div>
          @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('auth.' . $name . '.list_title') }}</h3>
            </div>
            <!-- /.box-header -->
            <div id="ajax_list" class="box-body">
            @include('auth.' . $name . '.ajax_list')
            </div>
            <div class="box-footer clearfix">
              {{ $data_list->links('auth.common.paging', ['paging' => $paging]) }}
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@endsection