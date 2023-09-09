<div style='margin:0px;width:95%;font-family: Arial,Helvetica,sans-serif;font-size:14px'> 
    <table style='width:100%;'>
        <tr>  
            @if (foqas_setting('logo_type') == 1)
                @php $logo = foqas_setting('express'); @endphp 
            @else 
                @php $logo = foqas_setting('standard'); @endphp 
            @endif
            <td>
                @empty($logo)
                    @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/favicon.png'; @endphp
                @endempty
                <img alt="{{school('short_name')}}" style="height:40px;" src="{{$logo}}">
            </td>
        </tr>
    </table>
    <hr style='margin-top:0px;'>
    <p>@lang('Hello'),</p> 
    <p>@lang('Thanks for registering at') {{school('name')}}.</p>
    <p><b>@lang('Here is your registration details:')</b></p> 
    <p><b>@lang('School Name:')</b> {{session('step1')['name']}}</p>
    <p><b>@lang('User Name:')</b> {{session('step1')['email']}}</p>
    <p><b>@lang('Password:')</b> {{session('step1')['password']}}</p>
    @php
        $type = array('1'=>'Stripe','2'=>'SSL');
        $currency = array('usd'=>'$','bdt'=>'৳');
    @endphp
    <p><b>@lang('Transction ID:')</b> {{$scPayment->trans_number}}</p>
    <p><b>@lang('Method Payment:')</b> {{$type[$scPayment->trans_type]}} Payment</p>
    <p><b>{{pricingfor($scPayment->purpose_id).' + '.subscription($scPayment->month)}} @lang('Subscription:')</b> {{$currency[$scPayment->currency].$scPayment->amount}}</p>
    <p><b>+Transaction Fee:</b> {{$currency[$scPayment->currency].$scPayment->stripe_fee}}</p>
    <p><b>@lang('Total Paid:')</b> {{$currency[$scPayment->currency].($scPayment->amount+$scPayment->stripe_fee)}}</p>

    <p><b>Website URL:</b> <a style="padding: 3px 8px;margin-left: 10px;border: 1px solid #ccc;font-weight: bold;cursor: pointer;" href="{{'https://'.session('completed')['sc_code'].'.foqasacademy.com'}}">{{session('completed')['sc_code'].'.foqasacademy.com'}}</a></p>
    <p><b>Login URL:</b> <a style="padding: 3px 8px;margin-left: 10px;border: 1px solid #ccc;font-weight: bold;cursor: pointer;" href="{{'https://'.session('completed')['sc_code'].'.foqasacademy.com/login'}}">{{session('completed')['sc_code'].'.foqasacademy.com/login'}}</a></p>
    <p><code>*@lang('Click on those links to go to your website and log in').</code></p> 
    <p>@lang('Thanks'),</p>
    <p>{{school('name')}} @lang('Team')</p> 
</div> 