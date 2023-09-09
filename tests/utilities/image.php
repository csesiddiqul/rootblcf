<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

function icpl_image($image)
{
    $first_4 = substr($image, 0, 4);
    if ($first_4 == 'http')
        return $image;
    else
        return url($image);
}

function upload_domain_path()
{
    return 'storage/';
}

function getLogo()
{
    if (foqas_setting('logo_type') == 1) {
        $logo = foqas_setting('express');
        if (empty($logo)) {
            $logo = 'storage/img/favicon.png';
        }
    } else {
        $logo = foqas_setting('standard');
        if (empty($logo)) {
            $logo = 'storage/img/icpl.png';
        }
    }
    return asset($logo);
}

function fileUpload($image, $fileType)
{
    $name = mt_rand(111, 999) . time();
    $upload_dir = fileUploadFolder() . '/' . $fileType . '/' . $name . '.png';
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);

    if (serverIsLocal() || config('app.env') != 'production') {
        Storage::disk('public')->put($upload_dir, base64_decode($image));
        $path = 'http://' . $_SERVER['HTTP_HOST'] . '/' . 'storage/' . $upload_dir;
    } else {
        /*$s3FolderPath = env('AWS_FOLDER_ROOT', 'https://foqasacademy.s3.us-east-2.amazonaws.com/');
        Storage::disk('s3')->put($upload_dir, base64_decode($image));
        $path = $s3FolderPath . $upload_dir;*/
        Storage::disk('public')->put($upload_dir, base64_decode($image));
        $path = upload_domain_path() . $upload_dir;
    }
    return $path;
}

function multiFileUpload($file, $folder = 'MULTIFILE')
{
    $fileName = mt_rand(111, 999) . time() . '.' . $file->extension();
    $upload_dir = fileUploadFolder() . '/' . $folder . '/' . $fileName;
    if (serverIsLocal() || config('app.env') != 'production') {
        Storage::disk('public')->put($upload_dir, file_get_contents($file));
        $path = 'http://' . $_SERVER['HTTP_HOST'] . '/' . 'storage/' . $upload_dir;
    } else {
        /*$s3FolderPath = env('AWS_FOLDER_ROOT', 'https://foqasacademy.s3.us-east-2.amazonaws.com/');
        Storage::disk('s3')->put($upload_dir, file_get_contents($file));
        $path = $s3FolderPath . $upload_dir;*/
        Storage::disk('public')->put($upload_dir, file_get_contents($file));
        $path = upload_domain_path() . $upload_dir;
    }
    return $path;
}


function uploadedImgDelete($table, $id, $field)
{
    if (\Request::ajax()) {
        $update = DB::connection(db_connection())->table($table)->whereId($id)->first();
        if (!empty($update)) {
            unlinkS3File($update->$field);
            DB::connection(db_connection())->table($table)->whereId($id)->update(array($field => null));
            if ($table == 'settings') {
                \Cache::forget('foqas_setting-' . school('id'));
            }
            return response()->json(['status' => 200]);
        }
    }
    return response()->json(['status' => 404]);
}

function unlinkS3File($field)
{
    @unlink($field);
    if ($field) {
        if (serverIsLocal()) {
            $field = str_replace(['http://192.168.0.109:8001/', 'http://127.0.0.0:8000/'], '', $field);
            @unlink($field);
        } else {
            /*    $oldpath = str_replace(env('AWS_FOLDER_ROOT'), '', $field);
                Storage::disk('s3')->delete($oldpath);*/
            @unlink($field);
        }
    }

}

function uploadedImgUpdated($table, $id, $field, $value)
{
    //return response()->json(['status' => $value]);
    if (\Request::ajax()) {
        $update = DB::connection(db_connection())->table($table)->whereId($id)->first();
        if (!empty($update)) {
            switch ($table) {
                case "users":
                    switch ($update->role) {
                        case "student":
                            $fileType = 'SP';
                            break;
                        case "admin":
                            $fileType = 'AP';
                            break;
                        default:
                            $fileType = 'STP';
                    }
                    break;
                case "settings":
                    switch ($field) {
                        case "standard":
                            $fileType = 'Standard';
                            break;
                        case "icon":
                            $fileType = 'Icon';
                            break;
                        case "about_pic":
                            $fileType = 'About';
                            break;
                        default:
                            $fileType = 'Express';
                    }
                    break;
            }
            $path = fileUpload($value, $fileType);

            DB::connection(db_connection())->table($table)->whereId($id)->update(array($field => $path));
            if ($table == 'settings') {
                \Cache::forget('foqas_setting-' . school('id'));
            }
            return response()->json(['status' => 200]);
        }
    }
    return response()->json(['status' => 404]);
}

function getIconByExtension($extension)
{
    if ($extension == 'png') {
        $imgIcon = asset('public/images/demo.png');
    } elseif ($extension == 'jpg') {
        $imgIcon = asset('public/images/demo.png');
    } elseif ($extension == 'jpeg') {
        $imgIcon = asset('public/images/demo.png');
    } elseif ($extension == 'pdf') {
        $imgIcon = asset('public/images/p_df.png');
    } elseif ($extension == 'doc') {
        $imgIcon = asset('public/images/word.png');
    } elseif ($extension == 'docx') {
        $imgIcon = asset('public/images/docx.png');
    } else {
        $imgIcon = asset('public/images/demo.png');
    }
    return $imgIcon;
}
