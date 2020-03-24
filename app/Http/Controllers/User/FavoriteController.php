<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Favorite;
use Auth;
use AnaliticL;
use Course;

class FavoriteController extends Controller
{
    public function add(Request $r){
    	if($r->delete == 'yes'){
    		$type = $r->type;
    		if(!$r->type){
    			$type = 'course';
    		}

    		Favorite::where('id', $r->id)->where('type', $type)->delete();
            AnaliticL::where('course', $r->analitic)->where('type', $type)->delete();

    		return response()->json(['result' => 'yes', 'id' => $r->id, 'like' => $r->id]);
    	}

    	Favorite::create(['user_id' => Auth::user()->id, 'course_id' => $r->id, 'type' => $r->type]);
        $course = Course::where('id', $r->id)->first();
        AnaliticL::addAnalitic($course->user_id, $r->id, $r->type);
    	$like = Favorite::where('user_id', Auth::user()->id)->where('course_id', $r->id)->orderBy('id', 'desc')->first();

    	return response()->json(['result' => 'yes', 'id' => $r->id, 'like' => $like->id, 'type' => $r->type]);
    }

    public function index(){
        if(!Auth::guest()){
            if(Auth::user()->type == 'organization'){
                return redirect()->route('cabinet.organization.favorite', app()->getLocale());
            }else{
                return redirect()->route('cabinet.person.favorite', app()->getLocale());
            }
        }

        return view('favorite');
    }
}
