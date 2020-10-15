@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/user.orders') }}</h3>

            @if(count($user_orders))
                <div id="orderAccordion" class="mb-15 accordion-with-icon">
                    @foreach($user_orders as $order)
                        <div class="card mb-15" id="orderHeading-{{ $loop->iteration }}">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <button class=" btn-link btn-block text-left text-decoration-none btn-faq" data-toggle="collapse" data-target="#orderCollapse-{{ $loop->iteration }}" aria-expanded="@if($loop->iteration == 1) true @else false @endif" aria-controls="orderCollapse-{{ $loop->iteration }}">
                                        <strong class="">#{{ $order->id }}</strong> {{ $order->name }}
                                    </button>
                                </h5>
                            </div>

                            <div id="orderCollapse-{{ $loop->iteration }}" class="collapse @if($loop->iteration == 1) show @endif" aria-labelledby="orderHeading-{{ $loop->iteration }}" data-parent="#orderAccordion">
                                <div class="card-body">
                                    <textarea class="form-control" rows="15">@forelse (explode('\r\n\r\n', $order->content) as $content){!! e(strlen($content) ? str_replace(' |  | ', ' | ', preg_replace('#(\r\n|\r|\n)#',' | ',trim(decrypt($content)))) . PHP_EOL . '---------' . PHP_EOL : '') !!}@empty N/A @endforelse</textarea>
                                </div>

                                <ul class="list-group list-group-flush">
                                    @if($order->getAmount() > 1)
                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.order_amount') }}</b> {{ $order->getAmount() }}
                                    </li>
                                    @endif

                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.price') }}</b> {{ $order->getFormattedPrice() }}
                                    </li>

                                    @if($order->delivery_price > 0)
                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.delivery_price') }}</b> {{ $order->getFormattedDeliveryPrice() }}
                                    </li>
                                    @endif

                                    @if($order->asWeight())
                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.bought_weight') }}</b> {{ $order->getWeight() . $order->getWeightChar() }}
                                    </li>
                                    @endif
                                    
                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.totalprice') }}</b> {{ $order->getFormattedTotalPrice() }}
                                    </li>

                                    @if(strlen($order->delivery_method) > 0)
                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.delivery_method.title') }}</b>  
                                        {{ $order->delivery_method }}
                                    </li>
                                    @endif

                                    @if(strlen($order->getDrop()) > 0)
                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.orders_order_note') }}</b><br />
                                        <p style="margin-top: 8px">
                                            {!! nl2br(e(decrypt($order->getDrop()))) !!}
                                        </p>
                                    </li>
                                    @endif

                                    @if($order->getStatus() != 'nothing')
                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.orders_status') }}</b>  
                                        @if($order->getStatus() == 'cancelled')
											{{ __('frontend/shop.orders.status.cancelled') }}
									    @elseif($order->getStatus() == 'completed')
									        {{ __('frontend/shop.orders.status.completed') }}
										@elseif($order->getStatus() == 'pending')
											{{ __('frontend/shop.orders.status.pending') }}
										@endif
                                    </li>
                                    @endif

                                    @if($order->hasNotes())
                                    <li class="list-group-item">
                                        <b>{{ __('frontend/shop.orders_notes') }}</b>
                                    </li>

                                    @foreach($order->getNotes() as $note)
                                    <li class="list-group-item list-group-order-note">
                                        {{ strlen($note->note) > 0 ? decrypt($note->note) : '' }}
                                        <span>{{ $note->getDateTime() }}</span>
                                    </li>
                                    @endforeach
                                    @endif

                                    <li class="list-group-item">
                                        <b>{{ __('frontend/user.date') }}</b> {{ $order->created_at->format('d.m.Y') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>

                {!! preg_replace('/' . $user_orders->currentPage() . '\?page=/', '', $user_orders->links()) !!}
            @else
                <div class="alert alert-warning">
                    {{ __('frontend/user.orders_page.no_orders_exists') }}
                </div>  
            @endif
        </div>
    </div>
</div>
@endsection
