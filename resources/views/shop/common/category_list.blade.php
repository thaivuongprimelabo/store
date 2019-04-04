@if($categories->count())
<aside class="aside-item sidebar-category collection-category">
	<div class="aside-title">
		<h2 class="title-head margin-top-0"><span>{{ trans('shop.category_txt') }}</span></h2>
	</div>
	<div class="aside-content">
		<div class="nav-category navbar-toggleable-md">
			<ul class="nav navbar-pills">
				@foreach($categories as $category)
				@php
					$childCategories = $category->getChildCategory();
				@endphp
				@if($childCategories->count())
				<li class="nav-item okactive">
<!-- 					<i class="fa fa-caret-right"></i> -->
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
					<a href="{{ $category->getLink() }}" class="nav-link">{{ $category->getName() }}</a>
					<i class="fa fa-angle-down"></i>
					<ul class="dropdown-menu">
						@foreach($childCategories as $child)
							<li class="dropdown-submenu nav-item">
								<i class="fa fa-caret-right"></i>
								<a class="nav-link" href="{{ $child->getLink() }}">{{ $child->getName() }} </a>
							</li>
						@endforeach
					</ul>
				</li>
				@else
				<li class="nav-item">
					<i class="fa fa-caret-right"></i>
					<a class="nav-link" href="/">Trang chủ</a>
				</li>
				@endif
				@endforeach
			</ul>
		</div>
	</div>
</aside>
@endif