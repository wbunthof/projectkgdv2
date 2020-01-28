<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GildeHerrineringsMailBeginVanHetJaar extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.GildeHerrineringsMailBeginVanHetJaar')
                    ->subject('Kringgildedag Inschrijfformulier')
                    ->attach(asset('/attachments/Uitnodiging2020.pdf'), [
                        'mime' => 'application/pdf'
                    ]);
    }
}
