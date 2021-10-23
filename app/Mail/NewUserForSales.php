<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Transcribejobs;

class NewUserForSales extends Mailable
{
    use Queueable, SerializesModels;


	public $job;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transcribejobs $job)
    {
         $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	
		
		
        return $this->view('emails.newuser');
    }
}
