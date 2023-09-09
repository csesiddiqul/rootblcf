<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        $provider = 'google';
        return Socialite::driver($provider)->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $existUser = User::bySchool(school('id'))->where('email', $googleUser->email)->first();
            if ($existUser) {
                if ($existUser->active == '1') {
                    if ($googleUser->user['email_verified'] && empty($existUser->email_verified_at))
                        $existUser->email_verified_at = now();
                    if (empty($existUser->photo) && isset($googleUser->avatar))
                        //$existUser->photo = self::socialFileUpload($googleUser->avatar);
                        $existUser->save();
                    Auth::loginUsingId($existUser->id);
                } else {
                    toast(transMsg('Ledger not active'), 'info')->timerProgressBar();
                    return redirect('login');
                }
            } else {
                toast(transMsg('Ledger not found in ' . school('name')), 'info')->timerProgressBar();
                return redirect('login');
            }
            return redirect()->route('home');
        } catch (Exception $e) {
            toast(transMsg('Something want to wrong, try again.'), 'error')->timerProgressBar();
            return redirect('login');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $existUser = User::where('email', $facebookUser->email)->first();
            if ($existUser) {
                if ($existUser->active == '1') {
                    if (empty($existUser->photo) && isset($facebookUser->avatar)) {
                        //$existUser->photo = self::socialFileUpload($facebookUser->avatar);
                        $existUser->save();
                    }
                    Auth::loginUsingId($existUser->id);
                } else {
                    // account not active
                    return redirect('login');
                }
            } else {
                //account not found
                return redirect('login');
            }
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect('login');
        }
    }

    private function socialFileUpload($url)
    {
        //not working  file upload system
        $contents = file_get_contents($url);
        $name = generateNumericKey() . date('Ymdhis') . '.png';
        $file = $_SERVER['DOCUMENT_ROOT'] . '/storage/profile/' . $name;
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $name);
        $st = new \App\Storage();
        $st->file = $name;
        $st->date = date('Y-m-d h:i:s');
        $st->save();
        return $st->id;
    }
}
