<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use Auth;
use App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Model\Category\Entity\Category;
use App\Filia;
use App\Course;
use Illuminate\Pagination\Paginator;
use App\Model\User\Entity\User;
use App\File;
use Illuminate\Contracts\Validation\ValidationException;
use App\Teachers;

use Intervention\Image\ImageManagerStatic as Image;

class CourseController extends Controller
{

    public function index(){
    	$org = Organization::getStatus();
    	$courses = Course::where('user_id', Auth::user()->id)->paginate(Auth::user()->course_pagination);
    	$page_number = '';

    	return view('cabinet.organization.course.home', compact('org', 'courses', 'page_number'));
    }

    public function add(){

    	$org = Organization::getStatus();
    	$filias = Filia::getUserFilia();
        $teachers = Teachers::getUserTeachers();
    	$categories = Category::getAll();
    	$catAll = new Category();
    	$cat = array();

        $c = 1;
    	foreach ($categories as $value) {
            if($value->id == 2){
                $c = 2;
            }
            if($value->id == 3){
                $c = 3;
            }
    		$res = $catAll->getPerrentCat($value->id);
    		if($res == "true" AND $c != 3){
    			$cat[] = [
    				'id' => $value->id,
    				'name' => (App::isLocale('ru'))? $value->name_ru : $value->name_uk,
                    'c_id' => $c
    			];
    		}
    	}

    	$page_number = '';
        $files = array();

    	return view('cabinet.organization.course.add', compact('org', 'cat', 'filias', 'page_number', 'files', 'teachers'));
    }

    public function addCourseDB(Request $r){
        $this->validate($r, [
            'filia' => 'required',
        ]);
        
    	Course::addCourse($r);

    	return redirect('/' . App::getLocale() . '/cabinet-organization/course');
    }

    function setPagination (Request $r){
    	$user = User::where('id', Auth::user()->id)->first();
    	$user->course_pagination = $r->count;
    	$user->save();
    }

    public function setStatus(Request $r){
    	$course = Course::where('id', $r->id)->first();
    	if($r->status != 6){
    		$course->status = $r->status;
    		$course->save();
    	}else{
    		Course::where('id', $r->id)->delete();
    	}

    	return redirect('/' . App::getLocale() . '/cabinet-organization/course');
    }

    public function edit($local, $id){
    	$org = Organization::getStatus();
    	$course = Course::where('id', $id)->where('user_id', Auth::user()->id)->first();

    	if(!$course){
    		return redirect('/' . App::getLocale() . '/cabinet-organization/course');
    	}

    	if($course->filia){
    		$filias = Filia::getUserFiliaEdit($course->filia);
    	}else{
			$filias = Filia::getUserFilia();
    	}

        if($course->teachers){
            $teachers = Teachers::getUserTeachersEdit($course->teachers);
        }else{
            $teachers = Teachers::getUserTeachers();
        }
    	$categories = Category::getAll_lft();
    	$catAll = new Category();
    	$cat = array();
    	$cat_current = Category::where('id', $course->category)->first();

    	$c = 1;
    	foreach ($categories as $value) {
    		if($value->id == 2){
				$c = 2;
			}
    		$res = $catAll->getPerrentCat($value->id);
    		if($res == "true" AND $value->id != $course->category){
    			$cat[] = [
    				'id' => $value->id,
    				'name' => (App::isLocale('ru'))? $value->name_ru : $value->name_uk,
    				'c_id' => $c
    			];
    		}
    	}

    	$page_number = $id;

        $files = File::where('user_id', Auth::user()->id)->where('type', 'course')->where('course_id', $course->id)->orderBy('sort', 'asc')->get();

    	return view('cabinet.organization.course.edit', compact('course', 'cat', 'filias', 'org', 'cat_current', 'page_number', 'files', 'teachers'));
    }

    public function update(Request $r){
    	Course::updateCourse($r);

    	return redirect()->back();
    }

    public function uploadPhotoMass(Request $request){
        $org = Organization::where('user_id', Auth::user()->id)->first();

        $file = $request->file('file');
        $title = $file->getClientOriginalName();
        $img = $file->store('storage', 'public');

        $image = $request->file('file');
        $filename = md5(microtime() . rand(0, 9999));

        $image_resize = Image::make($image->getRealPath());              
        // resize the image to a width of 210 and constrain aspect ratio (auto height)
        $image_resize->resize(null, 210, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image_resize->save(public_path('/storage/uploads/' . $filename));
        
        File::create([
            'user_id' => Auth::user()->id,
            'organization_id' => $org->id,
            'course_id' => $request->id,
            'title' => $title,
            'img' => '/storage/uploads/' . $filename,
            'type' => 'course',
            'uid' => $request->uid,
        ]);

        $img = File::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        return response()->json(['id' => $img->id, 'path' => $img->img]);
    }

    public function deleteAvatar(Request $r){
        Course::where('id', $r->id)->update(['logo_course' => '/img/default/no-image-course.jpg']);

        return redirect()->back();
    }
}
