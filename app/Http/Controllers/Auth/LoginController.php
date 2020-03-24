<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use App\Model\User\Entity\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends AppController
{

    use AuthenticatesUsers;

    public function redirectTo()
    {
        return app()->getLocale() . '/';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
    {
		$recaptha = $request->get('g-recaptcha-response');
		$check_cap = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdCLeIUAAAAADUZhPTgLC7txUQ3yx9ZPNcANOhu&response=$recaptha");
		$check_cap = json_decode($check_cap);
		if(!$check_cap)
		{
			 return back()->with('error', 'Капча не прошла проверку!');
		}
		
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        if ($this->attemptLogin($request)) {

            /** @var $user User */
            $user = $this->guard()->user();

            if ($user->isWait()) {
                auth()->logout();
                return back()->with('error', 'Пользователь не активен.');
            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


}
