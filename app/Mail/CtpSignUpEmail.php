<?php

namespace App\Mail;

use App\CtpSignUp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CtpSignUpEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $signup;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CtpSignUp $signup)
    {
        $this->signup = $signup;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.ctpsignup')
            ->subject('A controller has signed up for CTP Eastbound 2019');
    }
}
