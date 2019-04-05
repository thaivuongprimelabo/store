@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
<div class="row">
	<div class="col-xs-12">
		<h2><a href="#" class="title-box">Nhập từ khóa tìm kiếm </a></h2>
	</div>
	<div class="col-xs-12">
		<form action="/search" method="get" class="form-signup">
			
			<fieldset class="form-group">
				<input type="text" id="keyword_search" name="query" value="" placeholder="Tìm kiếm ..." class="form-control" style="width:300px; float:left;     line-height: 2.1;">
				<button id="search" type="button" class="btn btn-primary">Tìm kiếm</button>
			</fieldset>
		</form>  
	</div>
	<div class="col-xs-12">
		<h2 class="title-head">Có <span id="result_count">21</span> kết quả tìm kiếm phù hợp</h2>
	</div>
	<div class="col-xs-12">
		<div class="products-view-grid products">
			<div id="search_results" class="row row-gutter-14">
				
			</div>
			<div id="paging_link"></div>
		</div>
	</div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var keyword = location.search.split('=');
        $('#keyword_search').val(keyword[1]);
        var page_name = 'search-page';
    	var data = {
    		type : 'post',
    		async : true,
    		keyword: $('#keyword_search').val(),
    		page_name: page_name,
    		view_type: 'grid',
    		container: '#search_results',
    		paging: '#paging_link',
    	}
    
    	callAjax('{{ route('loadData') }}', data, page_name);

    	$(document).on('click', '.page-link', function(e) {
			var page_number = $(this).attr('data-page-number');
			callAjax('{{ route('loadData') }}?page=' + page_number, data, page_name);
    	});

    	$(document).on('click', '#search', function(e) {
        	data.keyword = $('#keyword_search').val();
    		callAjax('{{ route('loadData') }}', data, page_name);
    	});
    })
</script>
@endsection
