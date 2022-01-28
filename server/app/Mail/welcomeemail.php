<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class welcomeemail extends Mailable
{
    use Queueable, SerializesModels;

    public $firstname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Welcome $this->firstname")->view('emails.welcome')->with([
            'username' => $this->firstname,
        ]);
    }
}
