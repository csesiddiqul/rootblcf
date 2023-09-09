<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\LetsEncript;
use App\School;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Rogierw\RwAcme\Api;
use Rogierw\RwAcme\Endpoints\DomainValidation;
use Rogierw\RwAcme\Exceptions\DomainValidationException;
use Rogierw\RwAcme\Support\OpenSsl;

class LetsEncriptController extends Controller
{
    /*
     * https://acme-v02.api.letsencrypt.org/acme/acct/account_id
     * https://acme-v02.api.letsencrypt.org/acme/order/account_id/order_id
     * https://acme-v02.api.letsencrypt.org/acme/finalize/account_id/order_id
     * http://domain_name/.well-known/acme-challenge/filename
    */
    public function letsEncrypt()
    {
        $school = School::find(auth()->user()->school_id);
        if (!empty($school)) {
            $tableLetEncript = LetsEncript::whereSchool_id($school->id)->first();
            if ($tableLetEncript->status == 'valid') {
                return response()->json(['status' => '200', 'time' => '5000', 'icon' => 'info', 'msg' => transMsg("Already Secure your requested domain.")]);
            }
            $client = new Api('foqasgroup@gmail.com', __DIR__ . '/../../../../public_html/__account/' . \school('code'));

            //Creating an account
            if (!$client->account()->exists()) {
                $account = $client->account()->create();
            }
            // Or get an existing account.
            $account = $client->account()->get();

            $tableLetEncript->school_id = $school->id;
            $tableLetEncript->account_id = $account->id;
            $tableLetEncript->initialIp = $account->initialIp;
            $tableLetEncript->save();
            $newOrder = array();
            if (empty($tableLetEncript->order_id)) {
                //Creating an order
                $newOrder = $client->order()->new($account, [$tableLetEncript->domain]);
            }
            /*
                        $oid = print_r($newOrder->id) ?? $tableLetEncript->order_id;
                        //Getting an order
                        if (empty($oid))
                            return response()->json(['status' => '404', 'time' => '5000', 'icon' => 'error', 'msg' => 'Order id not found']);*/
            if (empty($tableLetEncript->order_id)) {
                $order = $client->order()->get($newOrder->id);
            } else {
                $order = $client->order()->get($tableLetEncript->order_id);
            }

            if (!empty($order)) {
                $tableLetEncript->order_id = $order->id;
                $tableLetEncript->status = $order->status;
                $tableLetEncript->expires = $order->expires;
                $tableLetEncript->save();

                //Getting the DCV status Domain validation
                $validationStatus = $client->domainValidation()->status($order);

                //Get the filename and content for the validation.
                $validationData = $client->domainValidation()->getFileValidationData($validationStatus);

                if ($validationData[0]['filename'] && $validationData[0]['content']) {
                    $s3FolderPath = env('AWS_FOLDER_ROOT', 'https://foqasacademy.s3.us-east-2.amazonaws.com/');
                    $upload_dir = fileUploadFolder() . '/LetsEncript/' . $validationData[0]['filename'];
                    Storage::disk('s3')->put($upload_dir, $validationData[0]['content']);
                    $tableLetEncript->filename = $validationData[0]['filename'] ?? '';
                    $tableLetEncript->content = $validationData[0]['content'] ?? '';
                    $tableLetEncript->object_url = $s3FolderPath . $upload_dir;
                    $tableLetEncript->save();
                }

                //Start domain validation dns-01
                try {
                    $client->domainValidation()->start($account, $validationStatus[0]);
                } catch (DomainValidationException $exception) {
                    // The local HTTP challenge test has been failed...
                }

                //Generating a CSR
                $privateKey = OpenSsl::generatePrivateKey();
                $csr = OpenSsl::generateCsr(["'" . $tableLetEncript->domain . "'"], $privateKey);

                //Finalizing order
                if ($order->isReady() && $client->domainValidation()->challengeSucceeded($order, DomainValidation::TYPE_HTTP)) {
                    $client->order()->finalize($order, $csr);
                }
                //Getting the actual certificate
                if ($order->isFinalized()) {
                    $certificateBundle = $client->certificate()->getBundle($order);
                    $tableLetEncript->status = 'valid';
                    $tableLetEncript->save();
                    return response()->json(['status' => '200', 'time' => '5000', 'icon' => 'info', 'msg' => transMsg("Secure Successfully.")]);
                }
            } else {
                return response()->json(['status' => '404', 'time' => '5000', 'icon' => 'error', 'msg' => transMsg('Order not found')]);
            }

            return response()->json(['status' => '404', 'time' => '5000', 'icon' => 'error', 'msg' => transMsg('Not complete.')]);
            /* if (isset($validationData[0]['filename']) && isset($validationData[0]['content'])) {

             }
             if (trim($tableLetEncript->status) == 'valid' && isset($tableLetEncript->domain)) {

             }*/
        }

        return response()->json(['status' => '404', 'time' => '5000', 'icon' => 'error', 'msg' => transMsg('Your School not found,Please try again latter.')]);

        /*//Revoke a certificate
        if ($order->isValid()) {
            $client->certificate()->revoke($certificateBundle->fullchain);
        }*/
    }

    public function customWeb($url)
    {
        try {
            $url = remove_http($url);
            $cname = dns_get_record($url, DNS_CNAME);
            if (isset($cname[0]['target'])) {
                $cname_target = $cname[0]['target'];
                $target = explode('.', $cname_target);
                $code = trim($target[0]);
                if ($code == auth()->user()->school->code) {
                    $school_id = auth()->user()->school_id;
                    $insert = LetsEncript::whereSchool_id($school_id)->first();
                    if (empty($insert)) {
                        $insert = new LetsEncript();
                        $insert->school_id = $school_id;
                        $insert->domain = $url;
                        $insert->status = 'domain_added';
                        $insert->save();
                        return response()->json(['status' => '200', 'time' => '5000', 'icon' => 'success', 'msg' => transMsg("Domain added successfully.")]);
                    }
                    return response()->json(['status' => '200', 'time' => '5000', 'icon' => 'info', 'msg' => transMsg("You can not add one more domain, your domain already add.")]);
                } else {
                    return response()->json(['status' => '404', 'time' => '5000', 'icon' => 'error', 'msg' => transMsg("CNAME doesn't from your request domain")]);
                }
            } else {
                return response()->json(['status' => '404', 'time' => '5000', 'icon' => 'error', 'msg' => transMsg('CNAME not found from your request domain')]);
            }
        } catch (\Exception $exception) {
            return response()->json(['status' => '404', 'time' => '5000', 'icon' => 'error', 'msg' => $url . transMsg(' is not valid domain')]);
        }
    }
}
