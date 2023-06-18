<?php

namespace Modules\Inventory\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ISellRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $sender;
    public $content;

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
        $email = $this->view('inventory::mails.sell_unit_request')
            ->from($this->sender)
            ->subject($this->subject)
            ->with([
                'content' => $this->content,
            ]);

        return $email;
    }
}
