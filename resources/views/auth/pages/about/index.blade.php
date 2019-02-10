@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
    {{ trans('auth.about.edit_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="create_form" action="?" method="post" enctype="multipart/form-data">
			@include('auth.common.alert')
			@if($about)
			@include('auth.common.edit_form',['forms' => trans('auth.about.form'), 'data' => $about])
			@else
			@include('auth.common.create_form',['forms' => trans('auth.about.form')])
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