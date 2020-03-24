<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reviews;
use App\Model\Region\Entity\Region;
use App\Organization;
use App\Model\Category\Entity\Category;

class ReviewsController extends Controller
{
    public function index (){
    	$lists = Reviews::where('complaint', 1)->orderBy('id', 'desc')->get();

    	return view('admin.reviews.index', compact('lists'));
    }

    public function show($id){
    	$course = Course::where('id', $id)->first();
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

    	return view('admin.course.view', compact('course', 'org', 'regions', 'cat'));

    }

    public function update(Request $r, $id){
    	if($r->delete == 'yes'){
    		Reviews::where('id', $id)->delete();

    		return redirect('/admin/reviews/list');
    	}

    	Reviews::where('id', $id)->update(['complaint' => 0]);

    	return redirect('/admin/reviews/list');
    }
}
