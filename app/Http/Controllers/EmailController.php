<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        // $order = Order::findOrFail($orderId);

        // Ship order...

        $send = Mail::to('xsebastianhrodriguezx@gmail.com')->send(new ContactUs());
        // $send = Mail::to('xsebastianhrodriguezx@gmail.com')->send('prueba');
        dd($send);
        var_dump($send);
    }
}
