@extends('layouts.shop')

@section('content')
<section class="awe-section-3" id="awe-section-3">
	<div class="section section-collection section-collection-1">
		<div class="container">
			<div class="collection-border">
				<div class="collection-main">
					<div class="row">
						<div class="col-lg-12 col-sm-12">
    						@include('shop.common.product',['title' => 'Sản phẩm mới'])
    						@include('shop.common.product',['title' => 'Bán chạy nhất'])
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="awe-section-8" id="awe-section-8">	
	<div class="section section_blog">
		<div class="container">
    		<div class="section-title a-center">
    			<h2><a href="https://dualeo-x.bizwebvietnam.net/tin-tuc">Tin cập nhật</a></h2>			
    			<p>Tin tức vệ sinh an toàn thực phẩm cập nhật mới nhất<br> mỗi ngày cho bạn</p>
    		</div>
    		<div class="section-content">
    			<div class="blog-slider owl-carousel" data-lg-items='3' data-md-items='3' data-sm-items='2' data-xs-items="2" data-nav="true">
    				@foreach($posts as $post)
    				<article class="blog-item text-center">
    					<div>
    						<div class="blog-item-thumbnail">						
    							<a href="{{ $post->getLink() }}">
    								
    								<img src="{{ $post->getImage() }}" alt="{{ $post->getTitle() }}">
    								
    							</a>
    						</div>
    						<div class="blog-item-info m-4">
    							<h3 class="blog-item-name"><a href="{{ $post->getLink() }}">{{ $post->getTitle() }}</a></h3>
    							<p class="blog-item-summary"> {{ $post->getSummary() }}</p>
    							<a class="btn" href="{{ $post->getLink() }}">Chi tiết</a>
    
    						</div>
    					</div>
    				</article>
    				@endforeach
    			</div>
    		</div>
    	</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
// 	$(document).ready(function() {
// 		var current_url = window.location.href.split('/');
// 		var data = {
// 			type : 'post',
// 			async : false,
// 			page_name: 'home-page',
// 			container: '#product_block',
// 		}

// 		loadProducts('{{ route('loadData') }}', data);

// 	})
</script>
@endsection
