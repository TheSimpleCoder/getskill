<?php

namespace App\Http\Controllers\Cabinet\Person;

use App\Http\Controllers\AppController;

class HomeController extends AppController
{

    public function index()
    {
        return redirect()->route('cabinet.person.profile.home', app()->getLocale());
    }
}
