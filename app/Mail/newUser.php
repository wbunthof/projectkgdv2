<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newUser extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $user;
    public $type;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
        $this->type = str_replace('App\\', '', get_class($this->user));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.newUser')->subject('U bent toegevoegde aan kringgildedag.nl!');
    }
}
