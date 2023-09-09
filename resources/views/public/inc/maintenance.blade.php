<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{transMsg('Maintenance')}} | {{transMsg(school('name') == 'name' ? config('app.name') : school('name'))}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<section>
    <div class="container">
        <div class="row">
            <div id="columns" class="container" style="color:red;text-align: center;">
                <center><img src="{{asset('image/maintenance.png')}}"/>
                    <h3><span style="color:#e74c3c;"><strong>{!! foqas_setting('unpublished_msg') !!}</strong></span>
                    </h3>
                </center>
            </div>
        </div>
    </div>
</section>
</body>
</html>