@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.delivery.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
			@include('auth.common.alert')
			@if($delivery)
			@include('auth.common.edit_form',['forms' => trans('auth.delivery.form'), 'data' => $delivery])
			@else
			@include('auth.common.create_form',['forms' => trans('auth.delivery.form')])
			@endif
			<div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{ trans('auth.button.submit') }}</button>
            </div>
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection