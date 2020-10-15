@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title">{{ __('frontend/user.deposit') }}</h3>

            <div class="card">
                <div class="card-header">{{ __('frontend/user.btc_cashin_title') }}</div>

                <div id="btc-cashin" class="card-body">
                    <div class="btc-cashin-box">
                        <h4>
                            {{ __('frontend/user.btc_cashin_title') }}
                        </h4>

                        <hr />

                        <span class="btc-cashin-info">
                            {!! __('frontend/user.btc_cashin_info') !!}
                        </span>

                        <img class="btc-cashin-img" src="https://chart.googleapis.com/chart?chs=180x180&chld=L|0&cht=qr&chl=bitcoin:{{ $btcWallet }}" />
                        
                        <input id="btc-cashin-wallet" type="text" onClick="this.select();" class="btc-cashin-input" value="{{ $btcWallet }}" readonly />
                        
                        <a href="javascript:void(0);" class="btc-cashin-copy-btn" data-clipboard-target="#btc-cashin-wallet">
                            {{ __('frontend/user.copy') }}
                            <ion-icon name="copy"></ion-icon>
                        </a>
                        <span class="btc-cashin-divider">|</span>
                        <a href="bitcoin:{{ $btcWallet }}">
                            {{ __('frontend/user.open_in_wallet') }}
                            <ion-icon name="open"></ion-icon>
                        </a>

                        <span class="btc-cashin-copy-info">{{ __('frontend/user.wallet_copied') }}</span>
                        
                        <hr />

                        <form method="POST" action="{{ route('deposit-btc-post', $userTransactionID) }}">
                            @csrf
                            
                            <button type="submit" class="btn btn-primary">{{ __('frontend/user.i_paid_button') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
