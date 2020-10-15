@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/main.shop') }}</h3>
        </div>
    </div>
</div>

<div class="container">
    @if(count(\App\Models\Product::all()))
        <div class="row">
        @if(count(App\Models\Product::getUncategorizedProducts()))
            <!--<h5>{{ __('frontend/shop.uncategorized') }}</h5>
            <div class="row">-->
            @foreach(App\Models\Product::getUncategorizedProducts() as $product)
                <div class="col-md-4">
                @include('frontend/shop.product_card')
                </div>
            @endforeach
            <!--</div>
        
            <hr />-->
        @endif

        @foreach($categories as $category)
            <!--<h5>{{ $category->name }}</h5>
            <div class="row">-->
            @foreach($category->getProducts() as $product)
                <div class="col-md-4">
                @include('frontend/shop.product_card') 
                </div>
            @endforeach
            <!--</div>-->

            @if(!$loop->last)
            <!--<hr />--> 
            @endif
        @endforeach
    </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    {{ __('frontend/shop.no_products_exists') }}
                </div>
            </div>   
        </div>
    @endif
</div>
@endsection
