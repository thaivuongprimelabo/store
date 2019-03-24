@extends('layouts.shop')

@section('content')
<!-- container -->
<div class="container">
	{!! Utils::createVendor() !!}
	<div id="product_block">
	</div>
</div>
<!-- /container -->
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		var current_url = window.location.href.split('/');
		var data = {
			type : 'post',
			async : false,
			page_name: 'home-page',
			container: '#product_block',
		}

		loadProducts('{{ route('loadData') }}', data);

	})
</script>
@endsection
