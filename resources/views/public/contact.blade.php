@extends('public.layout.public',['title' => transMsg('Contact') ])
@section('sliderText')
    <h1 class="page-title">@lang('CONTACT US')</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="contact-page-section sec-spacer">
        <div class="container">
            @php($map=foqas_setting('site_map'))
            @if(empty(!$map) && filter_var($map, FILTER_VALIDATE_URL))
                <div id="googleMap">
                    <iframe src="{{$map}}" width="100%" height="450" frameborder="0" style="border:0;"
                            allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            @endif
            <div class="row contact-address-section">
                <div class="col-md-4 pl-0">
                    <div class="contact-info contact-address">
                        <i class="fa fa-map-marker"></i>
                        <h4>@lang('Address')</h4>
                        <p>{{school('address')}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info contact-phone">
                        <i class="fa fa-phone"></i>
                        <h4>@lang('Phone Number')</h4>
                        <p>{{foqas_setting('telephone')}}</p>

                    </div>
                </div>
                <div class="col-md-4 pr-0">
                    <div class="contact-info contact-email">
                        <i class="fa fa-envelope"></i>
                        <h4>@lang('E-mail Address')</h4>
                        <p>{{foqas_setting('email')}}</p>

                    </div>
                </div>
            </div>
            <div class="contact-comment-section">
                <h3>@lang('Leave Comment')</h3>
                <div id="form-messages"></div>
                <form method="POST" id="contact-form" action="{{ route('contact.store') }}"
                      onsubmit="return validateRecaptcha();">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label> @lang('Name') <span class="text-danger">*</span> </label>
                                    <input name="name" id="name" class="form-control" type="text">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                   </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Phone')</label>
                                    <input name="phone" id="phone" class="form-control" type="text">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('E-mail') <span class="text-danger">*</span></label>
                                    <input name="email" id="email" class="form-control" type="email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Subject') <span class="text-danger">*</span></label>
                                    <input name="subject" id="subject" class="form-control" type="text">
                                    @if ($errors->has('subject'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Message') <span class="text-danger">*</span></label>
                                    <textarea cols="40" rows="10" id="message" name="message"
                                              class="textarea form-control"></textarea>
                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0"> 
                            <button class="g-recaptcha btn-send" type="button"
                            data-sitekey="6LfmRh4gAAAAAC9tIM1_a8aUsC8R0-rUL8cGgTC-" 
                            data-callback='onSubmit' 
                            data-action='submit'>@lang('Submit')</button> 
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
     <script src="https://www.google.com/recaptcha/api.js"></script>
      <script>
       function onSubmit(token) {
         document.getElementById("contact-form").submit();
       }
     </script>
     <style>
     .btn-send{
         text-transform: uppercase;
            color: #ffffff;
            background-color: #4a9fd7;
            margin-top: 15px;
            border: none;
            height: 50px;
            line-height: 50px;
            text-align: center;
            font-weight: 600;
            padding: 0 50px;
            cursor: pointer;
            transition: 0.4s;
            -webkit-transition: 0.4s;
            -ms-transition: 0.4s;
        }
     </style>
@endsection