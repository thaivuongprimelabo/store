<!-- BREADCRUMB -->
@if(isset($data))
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			@foreach($data as $key=>$value)
			@if($key == 'active')
			<li class="active">{{ $value }}</li>
			@else
			<li><a href="{{ $key }}">{{ $value }}</a></li>
			@endif
			@endforeach
		</ul>
	</div>
</div>
@endif