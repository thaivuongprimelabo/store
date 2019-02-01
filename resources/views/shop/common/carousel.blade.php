<div class="well np">
	<div id="myCarousel" class="carousel slide homCar">
		<div class="carousel-inner">
			@php
				$first = 0;
			@endphp
			@foreach($banners as $banner)
			<div class="item {{ $first == 0 ? 'active' : '' }}">
				<img style="width: 100%"
					src="{{ Utils::getImageLink($banner->banner) }}"
					alt="bootstrap ecommerce templates">
				<div class="carousel-caption">
					<h4>{{ $banner->description }}</h4>
				</div>
			</div>
			@php
				$first++;
			@endphp
			@endforeach
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>