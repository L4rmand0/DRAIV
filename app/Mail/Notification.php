<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->data['name_contact_us'];
        $lastname = $this->data['lastname_contact_us'];
        $company = $this->data['company_contact_us'];
        $email = $this->data['email_contact_us'];
        $message = filter_var ($this->data['message_contact_us'], FILTER_SANITIZE_STRING);
        // var_dump($message);
        // die;
        $industry = $this->data['industry_contact_us'];
        return $this->view('mails.mailnotification', [
            'name' => $name,
            'lastname' => $lastname,
            'company' => $company,
            'email' => $email,
            'messagef' => $message,
            'industry' => $industry,
        ])
        ->from('notification@draiv.co');
    }
}
