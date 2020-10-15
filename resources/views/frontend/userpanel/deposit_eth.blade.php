@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3 class="page-title">{{ __('frontend/user.deposit') }}</h3>

            <div class="card">
                <div class="card-header">{{ __('frontend/user.eth_cashin_title') }}</div>

                <div id="eth-cashin" class="card-body">
                    <div class="eth-cashin-box">
                        <h4>
                            {{ __('frontend/user.eth_cashin_title') }}
                        </h4>

                        <hr />

                        <span class="eth-cashin-info">
                            {!! __('frontend/user.eth_cashin_info') !!}
                        </span>

                        <img class="eth-cashin-img" src="https://chart.googleapis.com/chart?chs=180x180&chld=L|0&cht=qr&chl={{ $ethWallet }}" />
                        
                        <input id="eth-cashin-wallet" type="text" onClick="this.select();" class="eth-cashin-input" value="{{ $ethWallet }}" readonly />
                        
                        <a href="javascript:void(0);" class="eth-cashin-copy-btn" data-clipboard-target="#eth-cashin-wallet">
                            {{ __('frontend/user.copy') }}
                            <ion-icon name="copy"></ion-icon>
                        </a>
                        <span class="eth-cashin-divider">|</span>
                        <a href="eth:{{ $ethWallet }}">
                            {{ __('frontend/user.open_in_wallet') }}
                            <ion-icon name="open"></ion-icon>
                        </a>

                        <span class="eth-cashin-copy-info">{{ __('frontend/user.wallet_copied') }}</span>
                        
                        <hr />

                        <form method="POST" action="{{ route('deposit-eth-post', $userTransactionID) }}">
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
