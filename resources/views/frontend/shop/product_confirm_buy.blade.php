@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
		    <form method="POST" action="{{ route('buy-product-form-confirm') }}">
                <h3 class="page-title">{{ __('frontend/shop.product_confirm_buy') }}</h3>
                
                @if(!$product->dropNeeded())
                <div class="alert alert-warning">
                    {{ __('frontend/shop.start_video_alert') }}
                </div>
                @endif

                <div class="card mb-15">
                    @if($product->isSale())
                        <div class="product-tag product-tag-sale">
                            <span class="product-tag-percent">
                                {{ __('frontend/shop.sale', ['percent' => $product->getSalePercent()]) }}
                            </span>
                            {{ __('frontend/shop.tags.sale') }}
                            <span class="product-tag-old-price">
                                <s>{{ $product->getFormattedOldPrice() }}</s>  
                            </span>
                        </div>
                    @endif

                    <div class="card-header">{{ $product->name }}</div>

                    @if(strlen($product->short_description) > 0)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            {!! nl2br(decrypt($product->short_description)) !!}
                        </li>
                    </ul>
                    @endif

                    @if(strlen($product->description) > 0)
                    <div class="card-body">
                        {!! nl2br(decrypt($product->description)) !!}
                    </div>
                    @endif

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>{{ __('frontend/shop.category') }}</b>
                            <a href="{{ route('product-category', [$product->getCategory()->slug]) }}">
                                {{ $product->getCategory()->name }}
                            </a>
                        </li>
                    </ul>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>{{ __('frontend/shop.price') }}</b> {{ $product->getFormattedPrice() }}
                        </li>
                    </ul>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @if(!$product->asWeight())
                            <b>{{ __('frontend/shop.product_amount') }}</b> {{ $amount  }}
                            @else
                            <b>{{ __('frontend/shop.product_weight') }}</b> {{ $amount  }}{{ $product->getWeightChar() }}
                            @endif
                        </li>
                    </ul>
@if(isset($bonus) && $bonus != null)
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <b>Bonus:</b> {{ $bonus  }}
    </li>
</ul>
@endif

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>{{ __('frontend/shop.total_price') }}</b> {{ $totalPrice  }}
                        </li>
                    </ul>

                    @if($product->dropNeeded())
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>{{ __('frontend/shop.delivery_method.title') }}</b><br /><br />

                            @foreach(App\Models\DeliveryMethod::all() as $deliveryMethod)
                            <label class="k-radio k-radio--all k-radio--solid">
								<input type="radio" name="product_delivery_method" value="{{ $deliveryMethod->id }}" data-content-visible="false" data-weight-visible="false" @if(!$deliveryMethod->isAvailableAmount($totalPriceInCent)) disabled @endif />
							    <span></span>
								{{ __('frontend/shop.delivery_method.row', [
                                    'name' => $deliveryMethod->name,
                                    'price' => $deliveryMethod->getFormattedPrice()
                                ]) }}
                               
                                @if(!$deliveryMethod->isAvailableAmount($totalPriceInCent)))
                                <div class="delivery-method-info">
                                    {{ __('frontend/shop.delivery_method.minmaxinfo', [
                                        'min' => $deliveryMethod->getFormattedMinAmount(),
                                        'max' => $deliveryMethod->getFormattedMaxAmount()
                                    ]) }}
                                </div>
                                @endif
							</label><br />
                            @endforeach
                        </li>
                    </ul>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <label for="product_drop">{{ __('frontend/shop.order_note') }}</label>
                            <textarea class="form-control" name="product_drop" id="product_drop" placeholder="{{ __('frontend/shop.order_note_placeholder') }}">{{ old('product_drop') ?? \Session::get('productDrop') ?? '' }}</textarea>
                        </li>
                    </ul>
                    @endif

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="text-right">
                                 @csrf
                                        
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                <input type="hidden" name="product_amount" value="{{ $amount }}" />
                                <a href="{{ route('product-page', $product->id) }}" class="btn btn-outline-secondary">{{ __('frontend/shop.cancel_order') }}</a>
                                <button class="btn btn-primary" @if(!$product->isAvailable()) disabled @endif>{{ __('frontend/shop.confirm') }}</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>

@if(isset($replaceEntry) && $replaceEntry != null)
<hr />
            
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-danger">
                {{ __('frontend/shop.replace_rules_alert') }}
            </div>
        </div>
    </div>
</div>

<div id="faqAccordion" class="mb-15 accordion-with-icon">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-15">
                <div class="card">
                    <div class="card-header" id="faqHeading">
                        <h5 class="mb-0">
                            <button class="btn btn-link btn-block text-left text-decoration-none" data-toggle="collapse" data-target="#faqCollapse" aria-expanded="true" aria-controls="faqCollapse">
                                <strong class="text-dark">1.</strong> {{ $replaceEntry->question }}
                            </button>
                        </h5>
                    </div>

                    <div id="faqCollapse" class="collapse show" aria-labelledby="faqHeading" data-parent="#faqAccordion">
                        <div class="card-body">
                            {!! strlen($replaceEntry->answer) > 0 ? decrypt(nl2br($replaceEntry->answer)) : '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
