<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTicketEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var NewTicketEmail
     */
    public $newTicket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newTicket)
    {
        $this->newTicket = $newTicket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@phplaravel-65836-659002.cloudwaysapps.com')
                    ->view('mails.new_ticket');
    }
}
