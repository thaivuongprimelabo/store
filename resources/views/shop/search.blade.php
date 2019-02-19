@extends('layouts.shop')

@section('content')
<div class="container">
	@include('shop.common.product',['title' => '', 'data' => $products])
</div>
@endsection
