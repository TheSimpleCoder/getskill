<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Model\Region\Entity\Region;
use App\Organization;
use App\Model\Category\Entity\Category;

class CourseController extends Controller
{
    public function index (){
    	$lists = Course::where('status', '<>', 1)->Where('status', '<>', 3)->orderBy('id', 'desc')->get();

    	return view('admin.course.index', compact('lists'));
    }

    public function show($id){
    	$course = Course::where('id', $id)->first();
    	$org = Organization::where('id', $course->organization_id)->first();
    	$reg_ex = explode(',', $course->regions);
        $regions = Region::where('id', $course->regions)->first();
    	// $regions = '';
    	$_cat = explode(',', $course->category);
    	$cat = Category::where('id', $_cat[0])->first();
    	// foreach ($reg_ex as $key) {
    	// 	if($key != ''){
    	// 		$reg = Region::where('id', $key)->first();
    	// 		$regions .= $reg->mame_ru . ' ';
    	// 	}
    	// }

    	return view('admin.course.view', compact('course', 'org', 'regions', 'cat'));

    }

    public function update(Request $r, $id){
    	Course::where('id', $id)->update(['status' => $r->status, 'modern_message' => $r->mess]);

    	return redirect('/admin/course/list');
    }
}
