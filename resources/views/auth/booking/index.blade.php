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
                    <form id="search_form">
                            <div class="form-group">
                            	<div class="col-md-6">
                                    <div class="form-group has-feedback form-inline">
                                      <div class="input-group">
                                      	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                      	<input type="text" class="form-control datepicker" name="booking_time_fr_search" id="booking_time_fr_search" placeholder="dd/mm/yyyy" />
                                      </div>
                                      -
                                      <div class="input-group">
                                      	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                      	<input type="text" class="form-control datepicker" name="booking_time_to_search" id="booking_time_to_search" placeholder="dd/mm/yyyy" />
                                      </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-12 nopadding">
                              	 <div class="col-md-12">
                                	<button type="button" id="booking_search" class="btn btn-primary pull-right">{{ trans('auth.button.search') }}</button>
                              	 </div>
                            </div>
                    </form>
                 </div>
          </div>
          <div class="box">
            <!-- /.box-header -->
            <div id="ajax_list">
            	@include('helpers.booking.booking_list')
            </div>
          </div>
          <!-- /.box -->
        </div>
  	</div>
</section>
@endsection