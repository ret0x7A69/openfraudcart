@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title">{{ __('frontend/shop.product_details') }}</h3>

            @include('frontend/shop.product_card')

            <a href="{{ route('product-category', [$product->getCategory()->slug]) }}" class="btn btn-outline-secondary d-lg-none d-md-inline-block">{{ __('frontend/shop.to_shop') }}</a>
        </div>
    </div>
</div>
@endsection
