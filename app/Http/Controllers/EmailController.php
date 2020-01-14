<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Mail\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function sendContactUS(Request $request)
    {
        // echo '<pre>';
        $data_request = $request->all();

        // print_r($data_request);
        // die;
        // $name = $data_request['name'];
        // $lastname = $data_request['lastname'];
        // $company = $data_request['company'];
        $email = $data_request['email_contact_us'];
        // $message = $data_request['message'];
        // $industry = $data_request['industry'];

        $validator = Validator::make(
            $data_request,
            [
                'name_contact_us' => 'required',
                'lastname_contact_us' => 'required',
                'company_contact_us' => 'required',
                'email_contact_us' => 'required',
                'message_contact_us' => 'required',
                'industry_contact_us' => 'required',
            ],
            [
                'name_contact_us.required' => "El campo nombre es necesario",
                'lastname_contact_us.required' => "El campo apellido es necesario",
                'company_contact_us.required' => "El campo compañía es necesario",
                'email_contact_us.required' => "El campo email es necesario",
                'message_contact_us.required' => "El campo mensaje es necesario",
                'industry_contact_us.required' => "El campo industria es necesario",
            ]
        );

        $errors = $validator->errors()->getMessages();
        if(!empty($errors)){
            return response()->json(['response' => 'Campos incompletos.', 'errors' => $errors]);
        }else{
            $send = Mail::to($email)->send(new ContactUs($data_request));
            $send = Mail::to('notification@draiv.co')->send(new Notification($data_request));
            return response()->json(['response' => 'Hemos recibido su inquietud. Pronto nos pondremos en contacto con usted.', 'errors' => []]);
        }
    }
}
