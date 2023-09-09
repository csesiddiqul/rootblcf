@extends('layouts.app')
@section('content') 
    <link rel="stylesheet" href="{{asset('css/custome.css')}}"> 
    <script src="https://js.stripe.com/v3/"></script>
    <div id="registry" class="signup">
        <div class="signup-connect"> 
            <h1 class="name-title">{{session('step1')['name']}}</h1> 
            <div class="brdiv"></div>
            <div class="text-left">
                <p><b>@lang('E-mail:')</b> {{session('step1')['email']}}</p> 
                <p><b>@lang('Phone:')</b> {{session('step1')['phone_number']}}</p> 
                <p><b>@lang('EIIN:')</b> {{session('step2')['eiin']}}</p>
                <p><b>@lang('Est:')</b> {{session('step2')['established']}}</p>
                <p><b>@lang('Country:')</b> {{getCountryByCode(session('step1')['nationality'])['name']}}</p>
                <p>
                    @if(isset(session('step2')['district_id']))
                        <b>@lang('Division:')</b> {{getDivisionByDistrict(session('step2')['district_id'])['name']}}
                        <div class="clearfix"></div>
                        <b>@lang('District:')</b> {{getDistrictName(session('step2')['district_id'])}}
                    @elseif(isset(session('step2')['city']))
                        <b>@lang('City:')</b> {{session('step2')['city']}}
                    @elseif(isset(session('step2')['state_id']))
                        <b>@lang('State:')</b> {{getStateName(session('step2')['state_id'])}}
                    @endif
                </p>
                <p><b>@lang('Address:')</b> {!! nl2br(session('step2')['address']) !!}</p>
            </div>
            <div class="brdiv"></div>
            <a id="topback" href="{{route('school.info')}}" class="btn btn-social btn-back">
                <i class="fas fa-reply fa"></i>
                @lang('Step 2')
            </a> 
        </div>
        <div class="signup-classic" id="regForm">
            <h2>@lang('Register your account in') {{school('short_name') ?? school('name')}}</h2> 
            <ul class="progressbar">
                <li class="active"></li>
                <li class="active"></li>
                <li class="pre-active"></li>
                <li class=""></li>
            </ul>
            <div class="brdiv"></div>
            @if(!empty($pricing))
            <div class="alert alert-success alert-dismissible" role="alert"> 
                @if(!empty(session('validPrices')))
                    @php $priceGet = session('validPrices'); $code = $priceGet->code;  @endphp
                @else
                    @php $priceGet = $pricing; $code = null; @endphp
                @endif

                @php 
                    $total = ($priceGet->price + 0.30) / (1 - 0.029);
                    $amount = round($total, 2); 
                    $stripe_fee = round($total, 2) - $priceGet->price; 
                @endphp  

                <table id="pricingTable">
                    <caption>{{$priceGet->title}}</caption>
                    <tr> 
                        <td><span>{{pricingfor($priceGet->price_type).' + '.subscription($priceGet->subsMonth)}}</span> Subscription:</td>
                        <td>{!!'$<span>'.$priceGet->price.'</span>'!!}</td>
                    </tr>
                    <tr>
                        <td>+Transaction Fee:</td>
                        <td>{!!'$<span>'.$stripe_fee.'</span>'!!}</td>
                    </tr>
                    <tr>
                        <td>Total to be Paid:</td>
                        <td>{!!'$<span>'.$amount.'</span>'!!}</td>
                    </tr>
                    <tr>
                        <td class="permonth" colspan="2">
                            <sup>***</sup>Service charge ৳<span>{{$priceGet->perStudent}}</span>/month will be applicable for per student.
                        </td>
                    </tr>
                </table>
                <img src="" id="preview_cry">
            </div>
            <div class="clearfix"></div>

            {!! Form::open(array('route' =>'pay.now','method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'form'. ($errors->has('agentcode') || $errors->has('ref_number') ? ' validForm': ''),'id'=>'chargeform')) !!} 
            <fieldset>
                {!! Form::text('ref_number',$code, array('id' => 'ref_number','oninput' => 'stripeReferenceCode(this.value)', 'class' => 'input-text'.($errors->has('ref_number') ? ' has-error' : ''), 'placeholder' => trans('Reference Code'),($errors->has('ref_number') ? 'autofocus' : ''))) !!}
                <label class="label-helper" for="ref_number" id="indicator">@lang('Reference Code')</label> 
            </fieldset>
            <fieldset >
                {!! Form::text('agentcode', null, array('id' => 'agentcode','oninput' => 'agentCodeCheck(this.value)','class' => 'input-text'.($errors->has('agentcode') ? ' has-error' : ''), 'placeholder' => trans('Agent Number'),($errors->has('agentcode') ? 'autofocus' : ''))) !!}
                <label class="label-helper" for="agentcode" id="verifiedAgent">@lang('Agent Number')</label>
            </fieldset>   
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
                data-key="{{stripe_secretKey()}}"
                data-currency="usd"
                data-name="{{school('name')}}"
                data-email="{{session('step1')['email']}}"
                data-allow-remember-me="true"
                data-description="Online Payment"
                data-image="https://www.foqas.com/img/title_icon.png"
                data-locale="auto"
                data-panel-label="Payment Submit"
                data-label="Pay Now"
                data-zip-code="true">
            </script> 
            {!! Form::close() !!}
            @else
            <div class="alert alert-warning alert-dismissible" role="alert">  
                <img src="{{asset('image/foqas_cry.png')}}" id="preview_crys">
                <h5 class="text-center">
                    Registration fee has not been fixed. Please contact with {{school('name') ?? school('short_name')}}
                    <div class="clearfix"></div>
                    {{"Email: ".foqas_setting('email')}}
                    <div class="clearfix"></div>
                    {{"Phone: ".foqas_setting('phone')}}
                </h5> 
            </div>
            @endif
            <a id="bottomback" href="{{route('school.info')}}" class="btn btn-social btn-back">
                <i class="fas fa-reply fa"></i>
                @lang('Step 2')
            </a> 
        </div> 
    </div> 
@endsection
