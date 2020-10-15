@component('mail::message')
# @lang('mail.account_created.subject')

@lang('mail.account_created.text', ['appname' => config('app.name')])

@component('mail::button', ['url' => route('home'), 'color' => 'green'])
@lang('mail.account_created.button')
@endcomponent

@component('mail::panel')
    @lang('mail.account_created.panel', ['name' => $user->name, 'username' => $user->username])
@endcomponent

@lang('mail.regards')<br>
{{ config('app.name') }}
@endcomponent