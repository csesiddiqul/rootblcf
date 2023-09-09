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
    <p>@lang('Welcome to') {{school('name')}}</p>
    <p>@lang('Here is your verification code to complete registration process').</p> 
    <p><b>@lang('School Name:')</b> {{session('step1')['name']}}</p>
    <p><b>@lang('School E-mail:')</b> {{session('step1')['email']}}</p> 
    <p><b>@lang('Verification Code:')</b> <label style="padding: 3px 8px;margin-left: 10px;border: 1px solid #ccc;font-weight: bold;cursor: pointer;">{{session('step1')['code']}}</label></p>
    <p><code>*@lang('Please note that this link will expire in 1 hour from the time it was send').</code></p> 
    <p>@lang('Thanks'),</p>
    <p>{{school('name')}} @lang('Team')</p> 
</div>

