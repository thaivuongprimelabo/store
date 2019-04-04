@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<section class="page">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="page-title category-title">
					<h1 class="title-head"><a href="#">{{ trans('shop.main_nav.about.text') }}</a></h1>
				</div>
				<div class="content-page rte">
					{!! $about->content !!}
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
