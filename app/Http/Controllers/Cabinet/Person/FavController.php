<?php

namespace App\Http\Controllers\Cabinet\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Favorite;

class FavController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::user()->id);

        return view('cabinet.person.profile.favorite', compact('favorites'));
    }
}
