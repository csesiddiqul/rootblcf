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
    <p>@lang('Hello') {{session('step1')['name']}},</p>
    <p>@lang('You are successfully registered at '.school('name').', please find below details about your School Ledger:')</p>
    <br>
    <p><b>@lang('Ledger Information')</b></p>
    <p style='margin:0;'>@lang('School Name:') {{session('step1')['name']}}</p>
    <p style='margin:0;'>@lang('School Code:') {{session('completed')['sc_code']}}</p>
    <p style='margin:0;'>@lang('User Name:') {{session('step1')['email']}}</p>
    <p style='margin:0;'>@lang('Password:') {{session('step1')['password']}}</p>
    <br>
    @php
        $type = array('1'=>'Stripe','2'=>'SSL');
        $currency = array('usd'=>'$','bdt'=>'৳');
    @endphp
    <p><b>@lang('Payment Information')</b></p>
    <p style='margin:0;'>@lang('Transaction ID:') {{$scPayment->trans_number}}</p>
    <p style='margin:0;'>@lang('Method Payment:') {{$type[$scPayment->trans_type]}} Payment</p>
    <p style='margin:0;'>{{pricingfor($scPayment->purpose_id).' + '.subscription($scPayment->month)}} @lang('Subscription:') {{$currency[$scPayment->currency].$scPayment->amount}}</p>
    <p style='margin:0;'>+Transaction Fee: {{$currency[$scPayment->currency].$scPayment->stripe_fee}}</p>
    <p style='margin:0;'>@lang('Total Paid:') {{$currency[$scPayment->currency].($scPayment->amount+$scPayment->stripe_fee)}}</p>
    <br>
    <h1><b>@lang('Next Steps')</b></h1>
    <br>
    <p><b>@lang('Step 1 - Log in to your account')</b></p>
    <p style='margin:0;'><a href="https://www.foqasacademy.com" target="_blank">@lang('Go to:') www.foqasacademy.com</a></p>
    <p style='margin:0;'>@lang('School code:') {{session('completed')['sc_code']}}</p>
    <p style='margin:0;'>@lang('Email:') {{session('step1')['email']}}</p>
    <p style='margin:0;'>@lang('Password:') {{session('step1')['password']}}</p>
    <br>
    <p id="step2"><b>@lang('Step 2 - Setup your school domain')</b></p>
    <p style='margin:0;'>From your domain provider's site, please set your school's domain address to point to CNAME value "{{session('completed')['sc_code'].'.foqasacademy.com'}}"</p>
    <p style='margin:0;'><b>Note: </b> If you are using godaddy, see this link <a href="https://www.godaddy.com/help/add-a-cname-record-19236" target="_blank">https://www.godaddy.com/help/add-a-cname-record-19236</a></p>
    <br>
    <p><b>@lang('Step 3 - Contact us for SSL certificate')</b></p>
    <p style='margin:0;'>After you completed <a href="#step2">Step 2</a>, contact us <a href="https://foqasacademy.com/contact">https://foqasacademy.com/contact</a> to issue a SSL certificate for your school, this is to ensure your school's website can be accessed securely (via https) on that internet.</p>
    <br>
    <p>@lang('Thank you for registering your account'),</p>
    <p>{{school('name')}} @lang('Team')</p>
</div>
