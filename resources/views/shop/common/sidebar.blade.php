<section class="awe-section-1" id="awe-section-1">
	<div class="section_category_slider">
		<div class="container">
			<div class="row">
				@if($banners->count())
				<div class="col-md-9 col-md-push-3 px-md-4 px-0 mt-md-5 mb-5">
    				<div class="home-slider owl-carousel" data-lg-items='1' data-md-items='1' data-sm-items='1' data-xs-items="1" data-margin='0'  data-nav="true">
    					@foreach($banners as $banner)
    					<div class="item">
    						@if($banner->select_type == 'use_image')
    						<a href="{{ $banner->link }}" class="clearfix" target="_blank">
    							<img src="{{ Utils::getImageLink($banner->banner) }}" width="{{ $config['banners_width'] }}"  height="{{ $config['banners_height'] }}" alt="alt slider demo">
    						</a>
    						@else
    						<iframe width="{{ $config['banners_width'] }}" height="{{ $config['banners_height'] }}" src="https://www.youtube.com/embed/{{ $banner->youtube_id }}" frameborder="0" allowfullscreen></iframe>
    						@endif
    					</div>
    					@endforeach
    				</div><!-- /.products -->
    			</div>
    			@endif
    			<div class="col-md-3 col-md-pull-9 mt-5 hidden-xs aside-vetical-menu">
    				<aside class="blog-aside aside-item sidebar-category">	
    					<div class="aside-title text-center text-xl-left">
    						<h2 class="title-head"><span>Danh mục</span></h2>
    					</div>	
    					<div class="aside-content">
    						<div class="nav-category  navbar-toggleable-md" >
    							<ul class="nav navbar-pills">
    								@if($categories->count())
    								@foreach($categories as $category)
    								<li class="nav-item">
    									<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
    									<a class="nav-link" href="{{ $category->getLink() }}">{{ $category->getName() }}</a>
    									@php
									   		$childCategories = $category->getChildCategory();
									   	@endphp
									   	@if($childCategories->count())
									   	<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
									   	<ul class="dropdown-menu">
									   		@foreach($childCategories as $child)
									   		<li class="dropdown-submenu nav-item">
									   			<a class="nav-link" href="{{ $child->getLink() }}">{{ $child->getName() }}</a>
									   		</li>
									   		@endforeach
									   	</ul>
									  	@endif
    								</li>
    								@endforeach
    								@endif
    							</ul>
    						</div>
    					</div>
    				</aside>
    			</div>
			</div>
		</div>
	</div>
</section>