<?php

namespace Modules\Careers\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyCareer extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $sender;
    public $content;
    public $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $sender, $content, $file)
    {
        $this->subject = $subject;
        $this->sender = $sender;
        $this->content = $content;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('careers::mails.apply_career')
            ->from($this->sender)
            ->subject($this->subject)
            ->with('content', $this->content);

        if ($this->file) {        
            $email->attach($this->file, [
                'as' => $this->file->getClientOriginalName(),
                'mime' => $this->file->getMimeType(),
            ]);
        }

        return $email;
    }
}
