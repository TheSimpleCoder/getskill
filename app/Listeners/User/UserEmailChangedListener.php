<?php

namespace App\Listeners\User;

use App\Events\User\UserEmailChangedRequest;
use App\Mail\User\UserChangeEmail;
use \Illuminate\Mail\Mailer;

class UserEmailChangedListener
{
    private $mailer;


    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function handle(UserEmailChangedRequest $event)
    {
        $mail = new UserChangeEmail($event->user);
        $this->mailer->to($event->user->new_email)->send($mail);
    }
}
