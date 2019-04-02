@extends('layouts.app')

@section('content')
@include('auth.common.content_header')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
    			@if(isset($data) && $data->id)
    			@include('auth.common.edit_form')
    			@endif
            </form>
		</div>
	</div>
</section>
@endsection