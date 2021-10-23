<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HumanReview extends Mailable
{
    use Queueable, SerializesModels;
	
	public $job;
    public $transcriptionntext;
	

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job,$transcriptionntext)
    {
        $this->job = $job;
        $this->transcriptionntext = $transcriptionntext;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.humanreview');
    }
}
