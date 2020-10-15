@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title">{{ __('frontend/user.deposit') }}</h3>

            <div class="card">
                <div class="card-header">{{ __('frontend/user.payment_methods') }}</div>

                <div class="card-body">
                    <a href="{{ route('deposit-btc') }}" class="btn btn-warning btn-cashin @if(!App\Classes\BitcoinAPI::connected()) disabled @endif">{{ __('frontend/user.cashin_btc_button') }}</a>
                </div>
            </div>

            <div class="card mt-15">
                <div class="card-header">{{ __('frontend/user.coupon_redeem.title') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('redeem-coupon') }}">
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="coupon_redeem_code" class="text-md-right">{{ __('frontend/user.coupon_redeem.code') }}</label>
                        <input id="coupon_redeem_code" type="text" class="form-control{{ $errors->has('coupon_redeem_code') ? ' is-invalid' : '' }}" name="coupon_redeem_code" value="{{ old('coupon_redeem_code') }}" required autofocus>

                                @if ($errors->has('coupon_redeem_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('coupon_redeem_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('frontend/user.coupon_redeem.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
