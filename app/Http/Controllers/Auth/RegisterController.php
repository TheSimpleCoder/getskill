<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Model\User\Entity\User;
use Illuminate\Http\Request;
use App\UseCases\Auth\RegisterService;

class RegisterController extends AppController
{

//    use RegistersUsers;
//    protected $redirectTo = '/home';

    private $service;

    public function __construct(RegisterService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }


    public function redirectTo()
    {
        return app()->getLocale() . '/';
    }


    public function showPersonRegistrationForm(Request $request)
    {
        return view('auth.register-person');
    }

    public function showOrganizationRegistrationForm(Request $request)
    {
        return view('auth.register-organization');
    }

    public function register(RegisterRequest $request)
    {
		$recaptha = $request->get('g-recaptcha-response');
		$check_cap = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdCLeIUAAAAADUZhPTgLC7txUQ3yx9ZPNcANOhu&response=$recaptha");
		$check_cap = json_decode($check_cap);
		if(!$check_cap)
		{
			 return back()->with('error', 'Капча не прошла проверку!');
		}
		
        $this->service->register($request);

        return redirect()->route('login', app()->getLocale())
            ->with('success', trans('auth/register.Check your email and click on the link to verify.'));
    }


    public function verify($token)
    {
        if (!$user = User::where('verify_token', $token)->first()) {
            return redirect()->route('login', app()->getLocale())
                ->with('error', trans('auth/register.Sorry your link cannot be identified.'));
        }


        try {
            $this->service->verify($user->id);
            return redirect()->route('login', app()->getLocale())->with('success', trans('auth/register.Your e-mail is verified. You can now login.'));
        } catch (\DomainException $e) {
            return redirect()->route('login', app()->getLocale())->with('error', $e->getMessage());
        }
    }
}
