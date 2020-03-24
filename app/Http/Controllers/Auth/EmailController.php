<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use App\UseCases\User\Profile\ProfileService;
use Illuminate\Http\Request;

class EmailController extends AppController
{

    private $service;

    public function __construct(ProfileService $service)
    {
       $this->service = $service;
    }



    public function confirmNewEmail(Request $request, $token)
    {
        auth()->logout();
        session()->flush();
        
        try {
            $this->service->confirmNewEmail($token);
            $request->session()->flash('success', trans('cabinet/person/profile/change-email.Email changed success'));
        } catch (\DomainException $e) {
            $request->session()->flash('error', trans('cabinet/person/profile/change-email.Email changed error', ['error' => $e->getMessage()]));
        }

        return redirect()->route('login', app()->getLocale());
    }


}
