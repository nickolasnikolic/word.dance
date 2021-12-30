<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Poem;

class HateSpeechNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $poem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Poem $p)
    {
        $this->poem = $p;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.hateful');
    }
}
