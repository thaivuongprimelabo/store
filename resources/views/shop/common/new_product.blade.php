<div class="well well-small">
	<h3>New Products</h3>
	<hr class="soften" />
	<div class="row-fluid">
		<div id="newProductCar" class="carousel slide">
			<div class="carousel-inner">
				@php
					$index = 0;
				@endphp
				@foreach($new_products as $product)
				@php
					$a = (int) $index % 3;
				@endphp
				@if($a == 0)
				<div class="item {{ $index == 0 ? 'active' : '' }}">
				<ul class="thumbnails">
				@endif
						<li class="span3">
							<div class="thumbnail">
								<a class="zoomTool" href="product_details.html"
									title="add to cart"><span class="icon-search"></span> QUICK
									VIEW</a> <a href="#" class="tag"></a> <a
									href="product_details.html"><img
									src="{{ $product->getFirstImage($product->id) }}"
									alt="bootstrap-ring"></a>
							</div>
						</li>
				@php
					$index++;
					$a = (int) $index % 3;
				@endphp
				@if($a == 0)
				</ul>
				</div>
				@endif
				
				@endforeach
			</div>
			<a class="left carousel-control" href="#newProductCar"
				data-slide="prev">&lsaquo;</a> <a class="right carousel-control"
				href="#newProductCar" data-slide="next">&rsaquo;</a>
		</div>
	</div>
	<div class="row-fluid">
		<ul class="thumbnails">
			<li class="span4">
				<div class="thumbnail">

					<a class="zoomTool" href="product_details.html" title="add to cart"><span
						class="icon-search"></span> QUICK VIEW</a> <a
						href="product_details.html"><img
						src="{{ url('shop/assets/img/b.jpg') }}" alt=""></a>
					<div class="caption cntr">
						<p>Manicure & Pedicure</p>
						<p>
							<strong> $22.00</strong>
						</p>
						<h4>
							<a class="shopBtn" href="#" title="add to cart"> Add to cart </a>
						</h4>
						<div class="actionList">
							<a class="pull-left" href="#">Add to Wish List </a> <a
								class="pull-left" href="#"> Add to Compare </a>
						</div>
						<br class="clr">
					</div>
				</div>
			</li>
			<li class="span4">
				<div class="thumbnail">
					<a class="zoomTool" href="product_details.html" title="add to cart"><span
						class="icon-search"></span> QUICK VIEW</a> <a
						href="product_details.html"><img
						src="{{ url('shop/assets/img/c.jpg') }}" alt=""></a>
					<div class="caption cntr">
						<p>Manicure & Pedicure</p>
						<p>
							<strong> $22.00</strong>
						</p>
						<h4>
							<a class="shopBtn" href="#" title="add to cart"> Add to cart </a>
						</h4>
						<div class="actionList">
							<a class="pull-left" href="#">Add to Wish List </a> <a
								class="pull-left" href="#"> Add to Compare </a>
						</div>
						<br class="clr">
					</div>
				</div>
			</li>
			<li class="span4">
				<div class="thumbnail">
					<a class="zoomTool" href="product_details.html" title="add to cart"><span
						class="icon-search"></span> QUICK VIEW</a> <a
						href="product_details.html"><img
						src="{{ url('shop/assets/img/a.jpg') }}" alt=""></a>
					<div class="caption cntr">
						<p>Manicure & Pedicure</p>
						<p>
							<strong> $22.00</strong>
						</p>
						<h4>
							<a class="shopBtn" href="#" title="add to cart"> Add to cart </a>
						</h4>
						<div class="actionList">
							<a class="pull-left" href="#">Add to Wish List </a> <a
								class="pull-left" href="#"> Add to Compare </a>
						</div>
						<br class="clr">
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>