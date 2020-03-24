<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use Auth;
use App\Teachers;
use App;
use Pack;
use Course;
use Master;

class TeacherController extends Controller
{
    public function index(){
        if(Pack::getPack()['pack'] == 1){
            return redirect(App::getLocale().'/cabinet-organization/payment');
        }

    	$org = Organization::where('user_id', Auth::user()->id)->first();
    	$page_number = '';
    	$lists = Teachers::where('user_id', Auth::user()->id)->get();

    	return view('cabinet.organization.teachers.teachers', compact('org', 'page_number', 'lists'));
    }

    public function add(){
        if(Pack::getPack()['pack'] == 1){
            return redirect(App::getLocale().'/cabinet-organization/payment');
        }

    	$org = Organization::where('user_id', Auth::user()->id)->first();
    	$page_number = '';

    	return view('cabinet.organization.teachers.add', compact('org', 'page_number'));
    }

    public function save (Request $r){
    	Teachers::createNew($r);
    	return redirect('/' . App::getLocale() . '/cabinet-organization/teachers');
    }

    public function edit (Request $r, $local, $id){
        if(Pack::getPack()['pack'] == 1){
            return redirect(App::getLocale().'/cabinet-organization/payment');
        }
        
    	if($r->delete == 'yes'){
    		Teachers::where('id', $id)->delete();
            Course::where('teachers', $id)->update(['teachers' => null]);
            Master::where('teachers', $id)->update(['teachers' => null]);
    		return redirect('/' . App::getLocale() . '/cabinet-organization/teachers');
    	}
    	$val = Teachers::where('id', $id)->first();
    	if($r->status == 'yes'){
    		$val->status = 2;
    		$val->save();
    	}
    	
    	$page_number = $id;
    	return view('cabinet.organization.teachers.edit', compact('val', 'page_number'));
    }

    public function saveEdit(Request $r){
    	Teachers::updateInfo($r);
    	return redirect()->back();
    }
}
