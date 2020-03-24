<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Favorite extends Model
{
    protected $table = 'favorite';
    protected $fillable = ['user_id', 'course_id', 'type'];

    public static function checkAuth($id){
    	$result = Self::where('user_id', Auth::user()->id)->where('course_id', $id)->where('type', 'course')->first();

    	if(!$result){
    		return 'no';
    	}

    	return $result->id;
    }

    public static function countAuth(){
    	$result = Self::where('user_id', Auth::user()->id)->count();

    	return $result;
    }

    public static function checkAuthMaster($id){
        $result = Self::where('user_id', Auth::user()->id)->where('course_id', $id)->where('type', 'master')->first();

        if(!$result){
            return 'no';
        }

        return $result->id;
    }
}
