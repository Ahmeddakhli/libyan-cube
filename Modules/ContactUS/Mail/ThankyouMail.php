<?php

namespace Modules\ContactUS\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankyouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $sender;
    public $content;
    public $best_from;
    public $best_to;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $sender, $content)
    {
        $this->subject = $subject;
        $this->sender = $sender;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('contactus::mails.thank_you')
            ->from($this->sender)
            ->subject($this->subject)
            ->with([
                'content' => $this->content,
            ]);
        return $email;
    }
}
