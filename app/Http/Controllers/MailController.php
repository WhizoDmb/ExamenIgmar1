<?php

namespace App\Http\Controllers;

use App\Mail\MailTest;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;



class MailController extends Controller
{
    public function send()
    {
        // Crear Mail Model con "php artisan make:mail MailTest"
        $url = URL::signedRoute('mails.signed', now()->addSeconds(20)); // Proporciona un URL válido aquí

        Mail::to(['diego.cisneros.dp@gmail.com'])->send(new MailTest($url));


        return "Email enviado!";
        //dd($url);
    }

    public function checkUrl()
    {
        return 'Si jala';
    }
}
