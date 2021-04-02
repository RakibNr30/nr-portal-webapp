<?php


namespace App\Helpers;

use App\Mail\PortalMail;
use Illuminate\Support\Facades\Mail;

class MailManager
{
    public static function send($to, $data) {
        Mail::to($to)->send(new PortalMail($data));
    }
}