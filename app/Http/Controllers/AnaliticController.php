<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AnaliticO;
use AnaliticL;
use Course;
use Master;


class AnaliticController extends Controller
{
    public function openPhone(Request $r){
    	AnaliticO::addAnalitic($r);
    }

    public function favorite(Request $r){
    	if($r->action == 1){
    		if($r->type = 'course'){
	    		$id = Course::where('id', $r->id)->first();
	    		AnaliticL::addAnalitic($id->user_id, $r->id, $r->type);
	    	}else if($r->type = 'master'){
	    		$id = Master::where('id', $r->id)->first();
	    		AnaliticL::addAnalitic($id->user_id, $r->id, $r->type);
	    	}
    	}elseif($r->action == 2){
    		if($r->type = 'course'){
	    		AnaliticL::where('course', $r->id)->where('type', 'course')->delete();
	    	}else if($r->type = 'master'){
	    		AnaliticL::where('course', $r->id)->where('type', 'master')->delete();
	    	}
    	}
    }
}
