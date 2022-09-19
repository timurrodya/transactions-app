<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body,$emailto)
    {
        $this->body=$body;
        $this->emailto=$emailto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('admin@test.ru')->to($this->emailto)->markdown('mail.sendmessage');
    }
}
