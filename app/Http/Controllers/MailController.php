<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from Chelsea FC',
            'body' => 'for trial in the club'
        ];
        Mail::to('rabin.awale10@gmail.com')->send(new DemoMail($mailData));

        dd('Email send successfully.');
    }
}
