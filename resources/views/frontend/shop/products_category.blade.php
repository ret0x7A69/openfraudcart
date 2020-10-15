@extends('frontend.layouts.app')

@section('content')
<div class="container">
    @if(count($products))
        <h3 class="page-title">{{ \App\Classes\LangHelper::getValue(app()->getLocale(), 'product-category', null, $productCategory->id) ?? $productCategory->name }}</h3>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                @include('frontend/shop.product_card')
                </div>
            @endforeach
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    {{ __('frontend/shop.no_products_category_exists') }}
                </div>
            </div>   
        </div>
    @endif
</div>
@endsection
