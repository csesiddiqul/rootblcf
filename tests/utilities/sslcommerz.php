<?php
function ssl_default_store_id()
{
    return env('STORE_ID', 'ipsitasoftlive');
}

function ssl_default_store_password()
{
    return env('STORE_PASSWORD', 'ipsitasoftlive67909');
}

function ssl_store_id()
{
    if (school('id') == 1) {
        $id = faAcademy()->setting->ssl_store_id ?? ssl_default_store_id();
    } else {
        $sms_self = foqas_setting('ssl_self');
        if ($sms_self == 1) {
            $id = foqas_setting('ssl_store_id');
            if (!isset($id)) {
                $id = faAcademy()->setting->ssl_store_id ?? ssl_default_store_id();
            }
        } else {
            $id = faAcademy()->setting->ssl_store_id ?? ssl_default_store_id();
        }
    }
    return $id;
}

function ssl_store_password()
{
    if (school('id') == 1) {
        $password = faAcademy()->setting->ssl_store_password ?? ssl_default_store_password();
    } else {
        $sms_self = foqas_setting('ssl_self');
        if ($sms_self == 1) {
            $password = foqas_setting('ssl_store_password');
            if (!isset($password)) {
                $password = faAcademy()->setting->ssl_store_password ?? ssl_default_store_password();
            }
        } else {
            $password = faAcademy()->setting->ssl_store_password ?? ssl_default_store_password();
        }
    }
    return $password;
}