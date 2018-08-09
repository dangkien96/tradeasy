<?php

namespace App\Libs\Mail;


class SendMail {
	
	private $view, $params, $toMail, $subject;

	public function __construct($view, $params = [], $company, $subject = "") {
		$this->view    = $view;
		$this->params  = $params;
		$this->subject = $subject;
		$this->company = $company;
	}

	public function buildMail () {
        Mail::send($this->view, $this->params, function($message){
	        $message->to(config('mail.toMail'), $this->company)->subject($this->subject);
	    });
	}
}



    
