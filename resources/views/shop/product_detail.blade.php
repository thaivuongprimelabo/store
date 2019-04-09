@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
@php
	$images = $data->getImageDetails();
@endphp
<div class="container">
	<div class="row">
			<div class="col-lg-9 ">
				<div class="details-product">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-5">
							<div class="large-image">
								<a href="{{ $images->first()->getImageLink() }}" data-rel="">
									<img id="zoom_01" src="{{ $images->first()->getImageLink('medium') }}"  data-zoom-image="{{ $images->first()->getImageLink() }}" alt="{{ $data->getName() }}">
								</a>
<!-- 								<div class="hidden"> -->
<!-- 									<div class="item"> -->
<!-- 										<a href="{{ $images->first()->getImageLink('medium') }}" data-image="{{ $images->first()->getImageLink('medium') }}" data-zoom-image="{{ $images->first()->getImageLink('medium') }}" data-rel=""> -->
<!-- 										</a> -->
<!-- 									</div> -->
<!-- 								</div> -->
							</div>
							
							<div id="gallery_01" class="fixborder  owl-carousel owl-theme thumbnail-product" data-md-items="4" data-sm-items="4" data-xs-items="4" data-xss-items="2" data-margin="10" data-nav="true">
    							@foreach($images as $img)
    							<div class="item">
									<a class="clearfix" href="#" data-image="{{ $img->getImageLink('medium') }}" data-zoom-image="{{ $img->getImageLink() }}">
										<img  src="{{ $img->getImageLink('small') }}" alt="{{ $data->getName() }}">
									</a>
								</div>
								@endforeach
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-7 details-pro">
							<h1 class="title-head">{{ $data->getName() }}</h1>
							<div class="status clearfix">
								{{ trans('shop.status_txt') }}: 
								<span class="inventory"><i class="fa fa-check"></i> {{ $data->getStatusName() }}</span>
							</div>
							<div class="price-box clearfix">
							<div class="special-price">
								<span id="product_price_format" class="price product-price">{{ $data->getPrice() }}</span>
								<input type="hidden" id="product_price" value="{{ $data->price }}" /> 
							</div> <!-- Giá -->
							
							@php
								$productDetails = $data->getProductDetails();
							@endphp
							@foreach($productDetails as $detail)
							<div class="status clearfix mt-5">
								{{ $detail->group_name }}:
								@php
									$ids = explode(',', $detail['detail_id']);
									$names = explode(',', $detail['detail_name']);
									$prices = explode(',', $detail['detail_price']);
								@endphp
								@foreach($ids as $k=>$id)
								<span class="label label-default detail-item group-{{ $detail['group_id'] }}" style="cursor: pointer;padding:5px 10px;" data-group-id="{{ $detail['group_id'] }}" data-group-name="{{ $detail['group_name'] }}" data-id="{{ $id }}" data-product-id="{{ $data->id }}" data-name="{{ $names[$k] }}" data-price="{{ $prices[$k] }}"> {{ $names[$k] }}</span>
								@endforeach
							</div>
							@endforeach
						</div>
						<div class="product-summary product_description margin-bottom-15">
							<div class="rte description">
								{{ $data->getSummary() }}
							</div>
						</div>
						<div class="form-product ">
							<form enctype="multipart/form-data" id="add-to-cart-form" action="?" method="post" class="form-inline margin-bottom-10 dqdt-form">
								<div class="box-variant clearfix ">
									<input type="hidden" name="variantId" value="17898174">
								</div>
								<div class="form-group form-groupx form-detail-action clearfix ">
									<label class="f-left">{{ trans('shop.cart.qty_txt') }}: </label>
									<div class="custom custom-btn-number">
										<span class="qtyminus" data-id="{{ $data->id }}">-</span>
										<input type="text" class="input-text qty" title="Só lượng" value="1" maxlength="12" id="qty" name="quantity"  data-id="{{ $data->id }}">
										<span class="qtyplus" data-id="{{ $data->id }}">+</span>
									</div>
									<button type="button" class="btn btn-lg btn-primary btn-cart btn-cart2 btn-buy" title="{{ trans('shop.button.add_to_cart') }}"  data-id="{{ $data->id }}" data-qty="1">
										<span>{{ trans('shop.button.add_to_cart') }}  <i class="fa .fa-caret-right"></i></span>
									</button>
								</div>
							</form>
							<div class="social-sharing">
                                <div class="social-media" data-permalink="https://dualeo-x.bizwebvietnam.net/cherry-do-canada-loai-to-10">
                                	<label>{{ trans('shop.share_url') }}: </label>
                                	
                                	<a target="_blank" href="//www.facebook.com/sharer.php?u={{ $data->getLink() }}" class="share-facebook" title="Chia sẻ lên Facebook">
                                		<i class="fa fa-facebook-official"></i>
                                	</a>
                                	<a target="_blank" href="//twitter.com/intent/tweet?url={{ $data->getLink() }}" class="share-twitter" title="Chia sẻ lên Twitter">
                                		<i class="fa fa-twitter"></i>
                                	</a>
                                	<a target="_blank" href="//pinterest.com/pin/create/button/?url={{ $data->getLink() }}" class="share-pinterest" title="Chia sẻ lên pinterest">
                                		<i class="fa fa-pinterest"></i>
                                	</a>
                                	<a target="_blank" href="//plus.google.com/share?url={{ $data->getLink() }}" class="share-google" title="+1">
                                		<i class="fa fa-google-plus"></i>
                                	</a>
                                </div>
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-lg-12 margin-top-15 margin-bottom-10">
						<!-- Nav tabs -->
						<div class="product-tab e-tabs">
							<ul class="tabs tabs-title clearfix">
								<li class="tab-link" data-tab="tab-1">
									<h3><span>Mô tả</span></h3>
								</li>
								<li class="tab-link" data-tab="tab-2">
									<h3><span>Thông tin</span></h3>
								</li>
							</ul>
							<div class="tab-1 tab-content">
								<div class="rte">
									{{ $data->getSummary() }}
								</div>
							</div>
							<div class="tab-2 tab-content">
								{!! $data->getDescription() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<aside class="dqdt-sidebar sidebar right left-content col-lg-3">
			{!! Utils::createSidebarShop('category_list') !!}
            {!! Utils::createSidebarShop('popular_products') !!}
		</aside>
		
	</div>
		
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.detail-item').click(function(e) {
			var groupId = $(this).attr('data-group-id');
			$('.group-' + groupId).removeClass('label-success').addClass('label-default');
			$('.group-' + groupId).find('i').remove();
			$(this).prepend('<i class="fa fa-check"></i>');
			$(this).removeClass('label-default').addClass('label-success');
			var id = $(this).data('id');
			var pid = $(this).attr('data-product-id');
			var product_price = Number($('#product_price').val());
			var new_price = 0;
			
			$('.detail-item').each(function(index, item) {
				var item = $(item);
				if(item.hasClass('label-success')) {
					var price = item.attr('data-price');
					product_price += Number(price);
				}
			});

			new_price = Number(product_price);
			$('#product_price_format').html(formatCurrency(new_price, '.', '.'));

		});
	});

	$(document).on('click', '.btn-buy', function(e) {
		 var qty = $('.qty').val();
		 var items = [];
		 var data = {
			type : 'post',
       		async : true,
       		pid: $(this).attr('data-id'),
       		qty: qty,
       		items: [],
       		container: ['#cart_1', '.cartCount2', '#top_cart'],
       		dialog: '#popupCartModal'
		 }

		 $('.detail-item').each(function(index, item) {
			var item = $(item);
			if(item.hasClass('label-success')) {
				var item = {
					id: item.attr('data-id'),
					name: item.attr('data-name'),
					price: item.attr('data-price'),
					group_id: item.attr('data-group-id'),
					group_name: item.attr('data-group-name')
				}

				items.push(item);
			}
		 });

		 data.items = items;
		 callAjax('{{ route('addToCart') }}', data);
	 });
</script>
@endsection