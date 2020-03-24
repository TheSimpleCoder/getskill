<?php

namespace App\Http\Controllers\Cabinet\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reviews;
use Auth;

class ReviewsController extends Controller
{
    public function index(){
    	$lists = Reviews::where('user_id', Auth::user()->id)->get();

    	return view('cabinet.person.reviews.index', compact('lists'));
    }
}
