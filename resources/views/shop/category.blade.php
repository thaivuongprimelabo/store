@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
	<div class="row">
		<section class="main_container collection col-lg-9 col-lg-push-3">
			<div class="box-heading hidden relative">
				<h1 class="title-head margin-top-0">Tất cả sản phẩm</h1>				
			</div>
			<div class="category-products products">
				<div class="sortPagiBar">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 text-xs-left text-sm-right">
							<div class="bg-white clearfix">
								<div id="sort-by">
                					<label class="left hidden-xs">Sắp xếp: </label>
                					<ul>
                						<li><span class="val">Mặc định</span>
                							<ul class="ul_2">
                								<li><a href="javascript:;" onclick="sortby('default')">Mặc định</a></li>								
                								<li><a href="javascript:;" onclick="sortby('alpha-asc')">A → Z</a></li>
                								<li><a href="javascript:;" onclick="sortby('alpha-desc')">Z → A</a></li>
                								<li><a href="javascript:;" onclick="sortby('price-asc')">Giá tăng dần</a></li>
                								<li><a href="javascript:;" onclick="sortby('price-desc')">Giá giảm dần</a></li>
                								<li><a href="javascript:;" onclick="sortby('created-desc')">Hàng mới nhất</a></li>
                								<li><a href="javascript:;" onclick="sortby('created-asc')">Hàng cũ nhất</a></li>
                							</ul>
                						</li>
                					</ul>
                				</div>
                				<div class="view-mode f-left">				
                					<a href="javascript:;" data-view="grid">
                						<b class="btn button-view-mode view-mode-grid active ">
                							<i class="fa fa-th" aria-hidden="true"></i>					
                						</b>
                						<span>Lưới</span>
                					</a>
                					<a href="javascript:;" data-view="list" onclick="switchView('list')">
                						<b class="btn button-view-mode view-mode-list ">
                							<i class="fa fa-th-list" aria-hidden="true"></i>
                						</b>
                						<span>Danh sách</span>
                					</a>
                				</div>
							</div>
						</div>
					</div>
				</div>
				<section class="products-view products-view-{{ $type }}">
					<div class="row row-noGutter">
						@include('shop.common.product_ajax')
					</div>
				</section>
				{{ $products->links('shop.common.paging', ['paging' => $paging]) }}
			</div>
		</section>
		<aside class="dqdt-sidebar sidebar left left-content col-lg-3 col-lg-pull-9">
		{!! Utils::createSidebarShop('category_list'); !!}
		{!! Utils::createSidebarShop('price_search'); !!}
		{!! Utils::createSidebarShop('popular_products'); !!}
		</aside>
	</div>
</div>
@endsection