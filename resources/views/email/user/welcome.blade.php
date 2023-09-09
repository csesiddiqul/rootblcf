@component('mail::message')

# @lang('Welcome to') {{school('name') == 'name' ? config('app.name') : school('name')}}

@lang('Hi') {{ $name }},

@lang('We are glad to have you on board.')

@if(!is_null($password))
@lang('Your login details are as follows:')

**@lang('Email')**: {{ $email }}

**@lang('Password')**: {{ $password }}

@lang('You can change your password once logged-in.')
@else
    @lang('Please ask site administrator to know your login access.')
@endif

@auth
@component('mail::button', ['url' => url('/')])
    {{school('name') == 'name' ? config('app.name') : school('name')}}
@endcomponent
@else
@php
    $token = \Crypt::encrypt($email);
@endphp
@component('mail::button', ['url' => route('registry.active',['_token='.$token])])
    @lang('Now Active Ledger')
@endcomponent
@endauth

@lang('Thanks'),<br>
{{ config('app.name') }}
@endcomponent
