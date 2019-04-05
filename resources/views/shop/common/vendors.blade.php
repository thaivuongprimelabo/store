@if($vendors->count())
<section class="awe-section-10" id="awe-section-10">
	<div class="section section-brand mb-5">
		<div class="container">
			<div class="owl-carousel owl-theme" data-lg-items="6" data-md-items="5" data-sm-items="4" data-xs-items="3" data-xss-items="2" data-margin="30">
				@foreach($vendors as $vendor)
				<div class="brand-item">
    				<a href="{{ $vendor->getLink() }}" class="img25"><img src="{{ $vendor->getLogo() }}"  alt="{{ $vendor->getName() }}" >
    				</a>
    			</div>
    			@endforeach	
			</div>
		</div>
	</div>
</section>
@endif