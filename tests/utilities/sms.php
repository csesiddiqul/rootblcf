<?php

use Illuminate\Support\Facades\Storage;

function post_api($url, $body = null)
{
    $client = new \GuzzleHttp\Client();
    $response = $client->createRequest("POST", $url, ['body' => $body]);
    $response = $client->send($response);
    return $response;
}

function send_get_api($url, $body = null)
{
    try {
        $client = new GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', $url);
        $promise = $client->sendAsync($request)->then(function ($response) {
            return; // echo $response->getBody();
        });
        $promise->wait();
        return;
    } catch (Exception $exception) {
        return;
    }
}

function sms_default_key()
{
    return 'bm5sR2N4QWhDZGJrcmFFS05xYWo=';
}

function sms_default_ID()
{
    return '8801780597143';
}

function sms_api_key()
{
    if (school('id') == 1) {
        $key = foqas_setting('sms_api_key') ?? sms_default_key();
    } else {
        $sms_self = foqas_setting('sms_self');
        if ($sms_self == 1) {
            $key = foqas_setting('sms_api_key');
            if (!isset($key)) {
                $key = faAcademy()->setting->sms_api_key ?? sms_default_key();
            }
        } else {
            $key = faAcademy()->setting->sms_api_key ?? sms_default_key();
        }
    }
    return $key;
}

function sms_sender_id()
{
    if (school('id') == 1) {
        $id = foqas_setting('sms_sender_id') ?? sms_default_ID();
    } else {
        $sms_self = foqas_setting('sms_self');
        if ($sms_self == 1) {
            $id = foqas_setting('sms_sender_id');
            if (!isset($id)) {
                $id = faAcademy()->setting->sms_sender_id ?? sms_default_ID();
            }
        } else {
            $id = faAcademy()->setting->sms_sender_id ?? sms_default_ID();
        }
    }
    return $id;
}

function sms_balance()
{
    //https://easybulksmsbd.com/sms/api?action=check-balance&api_key=eHRPbGhPZXN6b21nRW9NTGVrYlA=&response=json
    //$url = "https://easybulksmsbd.com/sms/api?action=check-balance&api_key=" . sms_api_key() . "&response=json";
    $url = "https://bulksms.beepsystems.com/sms/api?action=check-balance&api_key=" . sms_api_key() . "&response=json";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sms_query($phone, $message)
{
    if (foqas_setting('sms_self') == 0) {
        $school = \App\School::code(school('code'))->first();
        $sms = sms_strlen($message);
        $array_number = explode(',', $phone);
        $total = count($array_number) * $sms;
        $school->increment('sms_count', $total);
    }

    $message = urlencode($message);
    //https://easybulksmsbd.com/sms/api?action=send-sms&api_key=eHRPbGhPZXN6b21nRW9NTGVrYlA=&to=PhoneNumber&from=SenderID&sms=YourMessage&unicode=1;
    //   $url = "https://easybulksmsbd.com/sms/api?action=send-sms&api_key=" . sms_api_key() . "&to=" . $phone . "&from=" . sms_sender_id() . "&sms=" . $message . "&unicode=1&otp=1";
    $url = "https://bulksms.beepsystems.com/sms/api?action=send-sms&api_key=" . sms_api_key() . "&to=" . $phone . "&from=" . sms_sender_id() . "&sms=" . $message . "&unicode=1&otp=1";
    return send_get_api($url);
}

function send_sms($phone, $message)
{
    $first_2 = substr($phone, 0, 2);
    $first_3 = substr($phone, 0, 3);
    if ($first_2 == '01') {
        $phone = '88' . $phone;
    } elseif ($first_3 != '880') {
        return response()->json(['code' => '500', 'error' => transMsg('Country code is missing, Number format is incorrect'), 'example' => '8801********', 'wrong_number' => $phone]);
    }
    return sms_query($phone, $message);
}

function send_sms_many($phone, $message)
{
    $toPhone = explode(',', $phone);
    $phone_array = [];
    foreach ($toPhone as $key => $value) {
        $first_2 = substr($value, 0, 2);
        $first_3 = substr($value, 0, 3);
        if ($first_2 == '01') {
            $value = '88' . $value;
        } elseif ($first_3 != '880') {
            return response()->json(['code' => '500', 'error' => transMsg('Country code is missing'), 'example' => '8801********', 'wrong_number' => $value]);
        }
        array_push($phone_array, $value);
    }
    $phone_array = implode(',', $phone_array);
    return sms_query($phone_array, $message);
}

function SMS_put_file($phone, $message)
{
    try {
        $put = [now(), '-' . $phone, '-' . $message];
        $upload_dir = fileUploadFolder() . '/' . 'sms' . '/' . date('Ymdhi') . '.txt';
        if (serverIsLocal() && config('app.env') != 'production') {
            Storage::disk('public')->put($upload_dir, $put);
            $path = 'http://' . $_SERVER['HTTP_HOST'] . '/' . 'storage/' . $upload_dir;
        } else {
            $s3FolderPath = env('AWS_FOLDER_ROOT', 'https://foqasacademy.s3.us-east-2.amazonaws.com/');
            Storage::disk('s3')->put($upload_dir, $put);
            $path = $s3FolderPath . $upload_dir;
        }
        return $path;
    } catch (Exception $exception) {
        return false;
    }

}

function email_put_file($emails, $message, $subject)
{

    try {
        $put['time'] = now();
        $put['subject'] = $subject;
        $put['email'] = $emails;
        $put['message'] = $message;
        $upload_dir = fileUploadFolder() . '/' . 'email' . '/' . date('Ymdhi') . '.txt';
        if (serverIsLocal() && config('app.env') != 'production') {
            Storage::disk('public')->put($upload_dir, $put);
            $path = 'http://' . $_SERVER['HTTP_HOST'] . '/' . 'storage/' . $upload_dir;
        } else {
            $s3FolderPath = env('AWS_FOLDER_ROOT', 'https://foqasacademy.s3.us-east-2.amazonaws.com/');
            Storage::disk('s3')->put($upload_dir, $put);
            $path = $s3FolderPath . $upload_dir;
        }
        return $path;
    } catch (Exception $exception) {
        return false;
    }

}

function sms_strlen($message)
{
    if (utf8_decode($message)) {
        $len = strlen(utf8_decode($message));
        if ($len <= '70')
            $sms = '1';
        else if ($len >= '70' && $len <= '140')
            $sms = '2';
        else if ($len >= '140' && $len <= '210')
            $sms = '3';
        else if ($len >= '210' && $len <= '280')
            $sms = '4';
        else if ($len >= '280' && $len <= '350')
            $sms = '5';
        else if ($len >= '350' && $len <= '420')
            $sms = '6';
        else if ($len >= '420' && $len <= '510')
            $sms = '7';
        else if ($len >= '510' && $len <= '580')
            $sms = '8';
        else if ($len >= '580' && $len <= '650')
            $sms = '9';
        else if ($len >= '650' && $len <= '720')
            $sms = '10';
    } else {
        $len = strlen($message);
        if ($len <= '160')
            $sms = '1';
        else if ($len >= '160' && $len <= '320')
            $sms = '2';
        else if ($len >= '320' && $len <= '480')
            $sms = '3';
        else if ($len >= '480' && $len <= '640')
            $sms = '4';
        else if ($len >= '640' && $len <= '800')
            $sms = '5';
        else if ($len >= '800' && $len <= '960')
            $sms = '6';
        else if ($len >= '960' && $len <= '1120')
            $sms = '7';
        else if ($len >= '1120' && $len <= '1280')
            $sms = '8';
        else if ($len >= '1280' && $len <= '1440')
            $sms = '9';
        else if ($len >= '1440' && $len <= '1600')
            $sms = '10';
    }
    return $sms;
}
