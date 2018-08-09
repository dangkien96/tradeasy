<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;


    public $view, $params, $subject, $company;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view, $params = [], $company, $subject = "")
    {
        $this->view    = $view;
        $this->params  = $params;
        $this->subject = $subject;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->from(config('mail.from.address'), $this->company)
                    ->subject($this->subject)
                    ->view('email.'.$this->view);
    }
}
