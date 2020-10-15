@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/user.settings') }}</h3>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('frontend/user.settings_change_password') }}</div>

                <div class="card-body">
                    @if(Session::has('successMessageSettingsPassword'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('frontend/main.close') }}">
                                <span aria-hidden="true">×</span>
                            </button>

                            {{ Session::get('successMessageSettingsPassword') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('settings-password-change') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                            <label for="settings_current_password" class="text-md-right">{{ __('frontend/user.settings_current_password') }}</label>

                        <input id="settings_current_password" type="password" class="form-control{{ $errors->has('settings_current_password') ? ' is-invalid' : '' }}" name="settings_current_password" value="{{ old('settings_current_password') }}" required autofocus>

                                @if ($errors->has('settings_current_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('settings_current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                             <div class="col-md-12">
                             <label for="settings_new_password" class="text-md-right">{{ __('frontend/user.settings_new_password') }}</label>

                            <input id="settings_new_password" type="password" class="form-control{{ $errors->has('settings_new_password') ? ' is-invalid' : '' }}" name="settings_new_password" value="{{ old('settings_new_password') }}" required autofocus>

                                @if ($errors->has('settings_new_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('settings_new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="settings_new_password_confirm" class="text-md-right">{{ __('frontend/user.settings_new_password_confirm') }}</label>
                         <input id="settings_new_password_confirm" type="password" class="form-control{{ $errors->has('settings_new_password_confirm') ? ' is-invalid' : '' }}" name="settings_new_password_confirm" value="{{ old('settings_new_password_confirm') }}" required autofocus>

                                @if ($errors->has('settings_new_password_confirm'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('settings_new_password_confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('frontend/user.settings_save_submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-15">
            <div class="card">
                <div class="card-header">{{ __('frontend/user.settings_change_jabber_id') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('settings-jabber-id-change') }}">
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                            <label for="settings_jabber_id" class="text-md-right">{{ __('frontend/user.settings_jabber_id') }}</label>
                                <input id="settings_jabber_id" type="email" value="{{ Auth::user()->jabber_id }}" class="form-control{{ $errors->has('settings_jabber_id') ? ' is-invalid' : '' }}" name="settings_jabber_id" value="{{ old('settings_jabber_id') }}" required autofocus>

                                @if ($errors->has('settings_jabber_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('settings_jabber_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="newsletter_enabled" id="newsletter_enabled" {{ Auth::user()->newsletter_enabled ? 'checked' : App\Models\Setting::get('settings_newsletter_enabled') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="newsletter_enabled">
                                        {{ __('frontend/user.settings_newsletter_enabled') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('frontend/user.settings_save_submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--
        <div class="col-md-8 mt-15">
            <div class="card">
                <div class="card-header">{{ __('frontend/user.settings_change_mail_address') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('settings-mail-address-change') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="settings_mail_address" class="text-md-right">{{ __('frontend/user.settings_mail_address') }}</label>

                            <div class="col-md-12">
                                <input id="settings_mail_address" type="email" value="{{ Auth::user()->email }}" class="form-control{{ $errors->has('settings_mail_address') ? ' is-invalid' : '' }}" name="settings_mail_address" value="{{ old('settings_mail_address') }}" required autofocus>

                                @if ($errors->has('settings_mail_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('settings_mail_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('frontend/user.settings_save_submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        -->
    </div>
</div>
@endsection
