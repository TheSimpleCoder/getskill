<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reviews;
use App\Organization;
use Auth;

class ReviewsController extends Controller
{
    public function index(){
    	$org = Organization::where('user_id', Auth::user()->id)->first();

    	return view('cabinet.organization.reviews.index', compact('org'));
    }

    public function saveEdit (Request $r){
    	Reviews::where('id', $r->id)->update(['text' => $r->text]);

    	return redirect()->back();
    }

    public function delete(Request $r){
    	Reviews::where('id', $r->id)->delete();

    	return redirect()->back();
    }
}
