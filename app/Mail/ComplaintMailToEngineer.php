<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintMailToEngineer extends Mailable
{
    use Queueable, SerializesModels;

    public $details, $messageContent;
 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $message)
    {
        $this->details = $details;
        $this->messageContent = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Emails.SendMailToEngineer')
        ->subject('Complaint Details.')
        ->with([
            'details' => $this->details,
            'messageContent' => $this->messageContent,
        ]);
    }
}
