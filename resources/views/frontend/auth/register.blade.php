@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="page-title">{{ __('frontend/user.register.title') }}</h3>

            <div class="card">
                <div class="card-header">{{ __('frontend/user.register.title') }}</div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                      <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                             <div class="col-md-12">
                             <label for="username" class="text-md-right">{{ __('frontend/user.username') }}</label>

                              <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="jabber_id" class="text-md-right">{{ __('frontend/user.jabber_id') }}</label>
                      <input id="jabber_id" type="email" class="form-control{{ $errors->has('jabber_id') ? ' is-invalid' : '' }}" name="jabber_id" value="{{ old('jabber_id') }}" required>

                                @if ($errors->has('jabber_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jabber_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="password" class="text-md-right">{{ __('frontend/user.register.password') }}</label>
                                   <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <div class="col-md-12">
                            <label for="password-confirm" class="text-md-right">{{ __('frontend/user.register.confirm_password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                             <div class="col-md-12">
                             <label for="password" class="text-md-right">{{ __('frontend/main.captcha') }}</label>
                               <div class="captcha-img">
                                    {!! captcha_img('math') !!}
                                </div>
                                <input type="text" class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" id="captcha" required />
                            
                                @if ($errors->has('captcha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="newsletter_enabled" id="newsletter_enabled" {{ old('newsletter_enabled') ? 'checked' : App\Models\Setting::get('register.newsletter_enabled') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="newsletter_enabled">
                                        {{ __('frontend/user.register.newsletter_enabled') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('frontend/user.register.submit') }}
                                </button>
                                <a href="{{ route('index') }}" class="btn btn-outline-secondary">
                                    {{ __('frontend/user.register.cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                            </div>
                        </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
