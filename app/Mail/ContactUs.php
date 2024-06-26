<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
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
        $message = $this->data['message_contact_us'];
        $industry = $this->data['industry_contact_us'];
        return $this->view('mails.mailcontactus', [
            'name' => $name,
            'lastname' => $lastname,
            'company' => $company,
            'email' => $email,
            'message' => $message,
            'industry' => $industry,
        ])
        ->from('notification@draiv.co');
    }
}
