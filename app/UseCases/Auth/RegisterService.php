<?php

namespace App\UseCases\Auth;

use App\Model\User\Entity\User;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use \Illuminate\Mail\Mailer;

class RegisterService
{
    private $mailer;
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher, Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

    public function register(RegisterRequest $request): void
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password'],
            $request['type']
        );

        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
    }

    public function verify($id): void
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        $user->verify();
    }
}
