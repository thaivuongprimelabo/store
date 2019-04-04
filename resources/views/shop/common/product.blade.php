<div class="e-tabs not-dqtab ajax-tab-1"  data-section="ajax-tab-1">
	<div class="row row-noGutter">
		<div class="col-sm-12">
			<div class="content">
				<div class="section-title">
					<h2>
						{{ $title }}
					</h2>
				</div>
				<div>
					<ul class="tabs tabs-title tab-mobile clearfix hidden-sm hidden-md hidden-lg">
						<li class="prev"><i class="fa fa-angle-left"></i></li>
						<li class="tab-link tab-title hidden-sm hidden-md hidden-lg current tab-titlexs" data-tab="tab-1">
							
							<span>Rau củ</span>
							
						</li>
						<li class="next"><i class="fa fa-angle-right"></i></li>
					</ul>
					<ul class="tabs tabs-title ajax clearfix hidden-xs">
						@if($categories->count())
						@foreach($categories as $key=>$category)
						<li class="tab-link has-content" data-tab="tab-{{ $key }}" data-url="">
							<span>{{ $category->name }}</span>
						</li>
						@endforeach
						@endif
						
					</ul>
					@if($categories->count())
					@foreach($categories as $key=>$category)
					<div class="tab-{{ $key }} tab-content">
						<div class="products products-view-grid">
							@php
								$products = $category->getProductInCategory($type);
							@endphp
							<div class="products products-view-grid">
								<div class="row">
									@foreach($products as $k=>$product)
									<div class="col-xs-6 col-xss-6 col-sm-4 col-md-3 col-lg-3">
										<div class="product-box">															
											<div class="product-thumbnail flexbox-grid">	
												<a href="{{ $product->getLinkDetail() }}" title="Vải thiều loại to">
													<img src="{{ $product->getFirstImage() }}"  data-lazyload="{{ $product->getFirstImage() }}" alt="Vải thiều loại to">
												</a>	
												<div class="product-action hidden-md hidden-sm hidden-xs clearfix">
													<div>
														<input type="hidden" name="variantId" value="17898181" />
														<button class="btn-buy btn-cart btn btn-primary   left-to add_to_cart" title="Đặt hàng">
															<i class="fa fa-shopping-bag"></i>						
														</button>
														
														<a href="{{ $product->getLinkDetail() }}" class="btn-gray btn_view btn right-to">
														<i class="fa fa-eye"></i></a>
													</div>
												</div>
											</div>
											<div class="product-info a-center">
												<h3 class="product-name"><a href="{{ $product->getLinkDetail() }}" title="Vải thiều loại to">{{ $product->getName() }}</a></h3>
												<div class="price-box clearfix">
													<div class="special-price">
														<span class="price product-price">{{ $product->getPrice() }}₫</span>
													</div>											
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>