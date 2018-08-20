<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $receiver, $type, $params, $company, $subject, $view;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($receiver, $view, $params, $company, $subject)
    {
        $this->receiver = $receiver;
        $this->params   = $params;
        $this->company  = $company;
        $this->subject  = $subject;
        $this->view     = $view;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->receiver)
                    ->send(new SendMail($this->view,  $this->params, $this->company, $this->subject) );
    }
}
