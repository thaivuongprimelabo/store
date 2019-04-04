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
									<img id="zoom_01" src="{{ $images->first()->getImageLink() }}" alt="Dưa leo Đà Lạt">
								</a>
								<div class="hidden">
									<div class="item">
										<a href="{{ $images->first()->getImageLink('medium') }}" data-image="{{ $images->first()->getImageLink('medium') }}" data-zoom-image="{{ $images->first()->getImageLink('medium') }}" data-rel="">
										</a>
									</div>
								</div>
							</div>
							
							<div id="gallery_01" class="fixborder  owl-carousel owl-theme thumbnail-product" data-md-items="4" data-sm-items="4" data-xs-items="4" data-xss-items="2" data-margin="10" data-nav="true">
    							@foreach($images as $img)
    							<div class="item">
									<a class="clearfix" href="#" data-image="{{ $img->getImageLink('small') }}" data-zoom-image="{{ $img->getImageLink('small') }}">
										<img  src="{{ $img->getImageLink('small') }}" alt="Dưa leo Đà Lạt">
									</a>
								</div>
								@endforeach
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-7 details-pro">
							<h1 class="title-head">{{ $data->getName() }}</h1>
							<div class="status clearfix">
								Trạng thái: <span class="inventory">
								<i class="fa fa-check"></i> Còn hàng
								</span>
							</div>
							<div class="price-box clearfix">
							<div class="special-price"><span class="price product-price">{{ $data->getPrice() }}</span> </div> <!-- Giá -->
						</div>
						<div class="product-summary product_description margin-bottom-15">
							<div class="rte description">
								{{ $data->getSummary() }}
							</div>
						</div>
						<div class="form-product ">
							<form enctype="multipart/form-data" id="add-to-cart-form" action="/cart/add" method="post" class="form-inline margin-bottom-10 dqdt-form">
								<div class="box-variant clearfix ">
									<input type="hidden" name="variantId" value="17898174">
								</div>
								<div class="form-group form-groupx form-detail-action clearfix ">
									<label class="f-left">{{ trans('shop.cart.qty_txt') }}: </label>
									<div class="custom custom-btn-number">
										<span class="qtyminus" data-field="quantity">-</span>
										<input type="text" class="input-text qty" data-field="quantity" title="Só lượng" value="1" maxlength="12" id="qty" name="quantity" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" onchange="if(this.value == '')this.value=1;">
										<span class="qtyplus" data-field="quantity">+</span>
									</div>
									<button type="submit" class="btn btn-lg btn-primary btn-cart btn-cart2 add_to_cart btn_buy add_to_cart" title="Cho vào giỏ hàng">
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
								{{ $data->getDescription() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<aside class="dqdt-sidebar sidebar right left-content col-lg-3">
            {!! Utils::createSidebarShop('right') !!}
		</aside>
		
	</div>
		
</div>
@endsection
