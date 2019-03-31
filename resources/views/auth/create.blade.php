@extends('layouts.app')

@section('content')
@include('auth.common.content_header',['title' => 'create_title'])
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
				<input type="hidden" id="demension" value="{{ $config['banner_image_size'] }}" />
				<input type="hidden" id="upload_limit" value="{{ $config['banner_maximum_upload'] }}" />
    			@include('auth.common.create_form')
            </form>
		</div>
	</div>
</section>
@endsection
