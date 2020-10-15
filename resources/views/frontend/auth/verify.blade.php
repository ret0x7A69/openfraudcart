@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('frontend/user.verify.title') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('frontend/user.verify.alerts.sent') }}
                        </div>
                    @endif

                    {{ __('frontend/user.verify.messages.before_proceeding') }}
                    {!! __('frontend/user.verify.messages.not_received_email', [ 'url' => route('verification.resend') ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
