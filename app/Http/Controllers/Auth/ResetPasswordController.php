<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends AppController
{

    use ResetsPasswords;


    public function redirectTo()
    {
        return app()->getLocale() . '/';
    }


    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
