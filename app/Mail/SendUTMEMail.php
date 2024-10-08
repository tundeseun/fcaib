<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User\User;

class SendUTMEMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
	public $user;
    public $file;

    /**
     * Create a new file instance.
     *
     * @return void
     */
    public function __construct($user, $file)
    {
	    $this->user = $user;
        $this->file = $file;
    }

    /**
     * Build the file.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this
            ->subject("FCAIB Post UTME Payment Receipt")
            ->markdown('emails.send-utme-mail')
            ->attach(url($this->file));
        return $mail;
    }
}
