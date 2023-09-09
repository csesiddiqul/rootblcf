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
    <p>@lang('Hello') {{$name}},</p> 
    <p>@lang('Welcome to') {{school('name')}}.</p>

    <p><b>@lang('Here is your login informations:')</b></p>  
    <p><b>@lang('User Name:')</b> {{$email}}</p>
    <p><b>@lang('Password:')</b> {{$password}}</p>

    <p><b>@lang('Log in URL:')</b> <a style="padding: 3px 8px;margin-left: 10px;border: 1px solid #ccc;font-weight: bold;cursor: pointer;" href="{{'https://foqasacademy.com/login'}}">foqasacademy.com/login</a></p>
    <p><code>*@lang('Click on this links for login to your account.')</code></p> 
    <p>@lang('Thanks'),</p>
    <p>{{school('name')}} @lang('Team')</p> 
</div> 