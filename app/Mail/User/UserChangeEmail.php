<?php

namespace App\Mail\User;

use App\Model\User\Entity\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserChangeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }



    public function build()
    {
        return $this->markdown('emails.user.change-email');
    }
}
