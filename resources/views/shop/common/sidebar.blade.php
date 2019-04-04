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
    				{!! Utils::createSidebarShop(); !!}
    			</div>
			</div>
		</div>
	</div>
</section>