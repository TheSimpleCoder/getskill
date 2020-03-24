<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends AppController
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;


    public function redirectTo()
    {
        return app()->getLocale() . '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
