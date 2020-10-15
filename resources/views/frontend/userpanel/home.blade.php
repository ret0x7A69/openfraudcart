@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/user.profile') }}</h3>

            <div class="card">
                <div class="card-header">{{ __('frontend/main.userpanel') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        {!! __('frontend/user.panel.welcome_message', [ 'name' => e(Auth::user()->username) ]) !!}
                    </p>

                    <p>
                        {!! __('frontend/user.panel.member_since', [ 'date' => e(Auth::user()->created_at->format('d.m.Y')) ]) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
