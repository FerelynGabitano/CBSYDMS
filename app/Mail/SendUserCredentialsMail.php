<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $credential_email;
    public $password;
    public $role_name;

    public function __construct($email, $credential_email, $password, $role_name)
    {
        $this->email = $email;
        $this->credential_email = $credential_email;
        $this->password = $password;
        $this->role_name = $role_name;
    }

    public function build()
    {
        return $this->subject('Your Batang Surigaonon Youth Credentials')
                    ->view('emails.user_credentials')
                    ->with([
                        'email' => $this->email,
                        'credential_email' => $this->credential_email,
                        'password' => $this->password,
                        'role_name' => $this->role_name,
                    ]);
    }
}
