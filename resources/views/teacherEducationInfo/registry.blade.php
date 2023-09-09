@extends('layouts.app')
@section('content')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"/>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Schoolbell"/>
    <link rel="stylesheet" href="{{asset('css/custome.css')}}">
    <!-- partial:index.partial.html -->
    <div id="registry" class="signup">
        <div class="signup-connect">
            <h1>@lang('Welcome to')<br>{{school('short_name') ?? school('name')}} </h1>
            @if (foqas_setting('express'))
                @php $logo = foqas_setting('express'); @endphp
            @endif
            @empty($logo)
                @php $logo = 'https://trello-attachments.s3.amazonaws.com/5f4f1c974719e18dcbcac0d8/5f4f1d43a5aabf803fbf0177/745f3e08d0efb80dd69b8e5d3fd66d82/Foqas_symbol_white.png'; @endphp
            @endempty
            <div class="forSlogo">
                <img src="{{$logo}}" alt="Logo" class="logoSchool">
            </div>
            <a id="topback" href="{{url('/')}}" class="btn btn-social btn-back">
                <i class="fas fa-home fa"></i>
                @lang('Back')
            </a>
        </div>
        <div class="signup-classic">
            <h2>Register to {{school('short_name') ?? school('name')}}</h2>
            {!! Form::open(array('route' =>'employee.store','method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'form')) !!}
            @if (session('registry_type'))
                <fieldset>
                    {!! Form::select('registry_type',array('librarian'=>'Librarian','accountant'=>'Accountant'),null,array('id' => 'registry_type', 'class' => 'input-text', 'placeholder' => trans('Select'),'required')) !!}
                    <label class="label-helper" for="registry_type">Register as</label>
                </fieldset>
            @endif
            <fieldset>
                {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'input-text', 'placeholder' => trans('Full Name'),'required')) !!}
                <label class="label-helper" for="name">Name</label>
                @error('name')
                <span class="help-block">
            <strong>{{ $message }}</strong>
          </span>
                @enderror
            </fieldset>
            <fieldset>
                {!! Form::email('email', NULL, array('id' => 'email', 'class' => 'input-text', 'placeholder' => trans('E-mail'),'required')) !!}
                @error('email')
                <span class="help-block">
            <strong>{{ $message }}</strong>
          </span>
                @enderror
                <label class="label-helper" for="email">E-mail</label>
            </fieldset>
            <fieldset>
                {{ Form::password('password', array('id' => 'password', 'class' => 'input-text','placeholder' =>'Password','required' => 'required')) }}
                @error('password')
                <span class="help-block">
            <strong>{{ $message }}</strong>
          </span>
                @enderror
                <label class="label-helper" for="password" id="greterorless">Password</label>
            </fieldset>
            <fieldset>
                {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'input-text', 'placeholder' =>'Re-type Password','required')) !!}
                @error('password_confirmation')
                <span class="help-block">
            <strong>{{ $message }}</strong>
          </span>
                @enderror
                <label class="label-helper" for="password_confirmation" id="indicator">Confirm password</label>
            </fieldset>
            <fieldset>
                {!! Form::select('nationality',$country,ip_info()['country_code'], array('id' => 'nationality', 'class' => 'input-text', 'placeholder' => trans('Nationality'),'required')) !!}
                <label class="label-helper" for="nationality">Nationality</label>
            </fieldset>
            <fieldset>
                {!! Form::tel('phone_number',null, array('id' => 'phone_number', 'class' => 'input-text','required')) !!}
            </fieldset>
            {!! Form::button(trans('Register Now'), array('class' => 'btn ','type' =>'submit','id'=>'regbtn' )) !!}
            {!! Form::close() !!}
            <a id="bottomback" href="{{url('/login')}}" class="btn btn-social btn-back">
                <i class="fas fa-home fa"></i>
                Back
            </a>
        </div>

    </div>
    <!-- partial -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script>
        var input = document.querySelector("#phone_number");
        window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function (success) {
                // Get your api-key at https://ipdata.co/
                fetch("https://api.ipdata.co/{{ip_info()['ip']}}?api-key=58083a1096b4aac9a5763e12442d129ed3d6b8685518ec62869cc8d8")
                    .then(function (response) {
                        if (!response.ok) return success("");
                        return response.json();
                    })
                    .then(function (ipdata) {
                        success(ipdata.country_code);
                    });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
        });

        /*For password*/
        $("#password").keyup(function () {
            if ($(this).val().length < 6) {
                $('#greterorless').html('*Password (Must be 6 characyers.)').css('color', 'red');
                $('#regbtn').attr({disabled: true});
            } else {
                $('#greterorless').html('Password').css('color', '#5f6368');
                $('#regbtn').attr({disabled: false});
            }
        });

        $('#password_confirmation').keyup(function () {
            var pass = $('#password').val();
            var cpass = $('#password_confirmation').val();
            if (pass != cpass) {
                $('#indicator').html('*Confirm password (Not matching)').css('color', 'red');
                $('#regbtn').attr({disabled: true});
            } else {
                $('#indicator').html('Password Confirmed').css('color', '#5f6368');
                $('#regbtn').attr({disabled: false});
            }
        });
    </script>
@endsection
