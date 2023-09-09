<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin')->except('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contacts'] = Contact::bySchool(Auth::user()->school->id)->get();
        return view('contact.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'subject' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string|max:2000'
        ]);
        $name = $request->get('name');
        $phone = $request->get('phone');
        $subject = $request->get('subject');
        $email = $request->get('email');
        $message = $request->get('message');
        $contact = new Contact();
        $contact->school_id = school('id');
        $contact->name = filter_var($name, FILTER_SANITIZE_STRING);
        $contact->phone = filter_var($phone, FILTER_SANITIZE_STRING);
        $contact->subject = filter_var($subject, FILTER_SANITIZE_STRING);
        $contact->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $contact->message = filter_var($message, FILTER_SANITIZE_STRING);
        $contact->ip_address = $request->getClientIp();
        $contact->save();
        Mail::send('email.contact', ['contact' => $contact], function ($m) use ($contact) {
            if (school('id') == 14) {
                $email = ['mgsabur@gmail.com', 'milia_sabed@hotmail.com'];
            } else {
                $email = foqas_setting('email');
            }
            $subject = 'A Contact Message has been Received Time: ' . date('h:i a', strtotime($contact->created_at)) . ' Date: ' . date('d M, Y', strtotime($contact->created_at));
            $m->from(config('mail.from.address'), \school('name'));
            $m->to($email)->subject($subject);
            /*$bccEmails = ['md@ipsitasoft.com'];
            $m->bcc($bccEmails)->subject($subject);*/
        });
        toast(transMsg("Your message has been received, We'll get back to you shortly"), 'success')->timerProgressBar();
        return redirect()->back();
        $blacklistArray = array('Dating', 'dating', 'sех', 'Sех', 'Sеxу', 'seхy girls', 'adult', 'romantic girls', 'beautiful girls', 'adultdating', 'adultdatingsex', 'harassment', 'blackmail');
        $matches = array();
        $nameMatchFound = preg_match_all("/\b(" . implode($blacklistArray, "|") . ")\b/i", $name, $matches);
        $phoneMatchFound = preg_match_all("/\b(" . implode($blacklistArray, "|") . ")\b/i", $phone, $matches);
        $emailMatchFound = preg_match_all("/\b(" . implode($blacklistArray, "|") . ")\b/i", $email, $matches);
        $messageMatchFound = preg_match_all("/\b(" . implode($blacklistArray, "|") . ")\b/i", $message, $matches);
        $subjectMatchFound = preg_match_all("/\b(" . implode($blacklistArray, "|") . ")\b/i", $subject, $matches);

        // if it find matches bad words

        if ($nameMatchFound || $phoneMatchFound || $emailMatchFound || $messageMatchFound || $subjectMatchFound) {
//            $words = array_unique($matches[0]);
            toast(transMsg('You can not use adult text, please remove adult text and try again !'), 'error')->timerProgressBar();
            return redirect()->back();
        } else {
            $contact = new Contact();
            $contact->school_id = school('id');
            $contact->name = filter_var($name, FILTER_SANITIZE_STRING);
            $contact->phone = filter_var($phone, FILTER_SANITIZE_STRING);
            $contact->subject = filter_var($subject, FILTER_SANITIZE_STRING);
            $contact->email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $contact->message = filter_var($message, FILTER_SANITIZE_STRING);
            $contact->ip_address = $request->getClientIp();
            $contact->save();

            /*  Mail::send('email.contactmail', ['contact' => $contact], function ($m) use ($contact) {
                  $m->from(config('mail.username'), getSetting('title'));
                  $m->to($contact->email, $contact->firstname . ' ' . $contact->surname)->subject('New Contact Mail');
              });

              Mail::send('email.contactAdmin', ['contact' => $contact], function ($m) use ($contact) {
                  $m->from(config('mail.username'), getSetting('title'));
                  $m->to('info@paywellgetwell.com')->subject('New Contact Mail');
                  $bccEmails = ['atique@paywellgetwell.com', 'faizur@paywellgetwell.com', 'mdraj7143@gmail.com', 'tusar@paywellgetwell.com'];
                  $m->bcc($bccEmails)->subject('New Contact Mail');
              });*/
            toast(transMsg("Your message has been received, We'll get back to you shortly"), 'success')->timerProgressBar();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        if ($contact->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }
        $data['contact'] = $contact;
        return view('contact.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if ($contact->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'subject' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string|max:2000'
        ]);
        $contact->name = filter_var($request->name, FILTER_SANITIZE_STRING);
        $contact->phone = filter_var($request->phone, FILTER_SANITIZE_STRING);
        $contact->subject = filter_var($request->subject, FILTER_SANITIZE_STRING);
        $contact->email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $contact->message = filter_var($request->message, FILTER_SANITIZE_STRING);
        $contact->remark = filter_var($request->remark, FILTER_SANITIZE_STRING);
        $contact->save();
        toast(transMsg('Contact Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if ($contact->school_id == Auth::user()->school_id) {
            $contact->delete();
        }
        toast(transMsg('Contact Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.contact.index');

    }
}
