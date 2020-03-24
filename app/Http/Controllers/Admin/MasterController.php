<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Master;
use App\Model\Region\Entity\Region;
use App\Organization;
use App\Model\Category\Entity\Category;

class MasterController extends Controller
{
    public function index (){
    	$lists = Master::where('status', '<>', 1)->Where('status', '<>', 3)->orderBy('id', 'desc')->get();

    	return view('admin.master.index', compact('lists'));
    }

    public function show($id){
    	$course = Master::where('id', $id)->first();
    	$org = Organization::where('id', $course->organization_id)->first();
    	$reg_ex = explode(',', $course->regions);
    	$regions = '';
    	$_cat = explode(',', $course->category);
    	$cat = Category::where('id', $_cat[0])->first();
    	foreach ($reg_ex as $key) {
    		if($key != ''){
    			$reg = Region::where('id', $key)->first();
    			$regions .= $reg->mame_ru . ' ';
    		}
    	}

    	return view('admin.master.view', compact('course', 'org', 'regions', 'cat'));

    }

    public function update(Request $r, $id){
    	Master::where('id', $id)->update(['status' => $r->status, 'modern_message' => $r->mess]);

    	return redirect('/admin/master/list');
    }
}
