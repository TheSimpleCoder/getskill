<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use Auth;
use App\Model\Category\Entity\Category;
use App;
use App\Filia;
use App\Master;
use App\File;
use Illuminate\Contracts\Validation\ValidationException;
use App\Teachers;
use Pack;

use Intervention\Image\ImageManagerStatic as Image;

class MasterController extends Controller
{
    
	public function index(){
        if(Pack::getPack()['pack'] == 1){
            return redirect(App::getLocale().'/cabinet-organization/payment');
        }

		$masters = Master::where('user_id', Auth::user()->id)->paginate(Auth::user()->course_pagination);
		$org = Organization::where('user_id', Auth::user()->id)->first();

		return view('cabinet.organization.master.index', compact('masters', 'org'));
	}

    public function add(Request $r){
        if(Pack::getPack()['pack'] == 1){
            return redirect(App::getLocale().'/cabinet-organization/payment');
        }

    	$org = Organization::where('user_id', Auth::user()->id)->first();
    	$categories = Category::getAll();
        $teachers = Teachers::getUserTeachers();
    	$cat = array();
    	$select_cat = 1;
    	$filias = Filia::getUserFilia();
    	foreach ($categories as $value) {
    		$res = Category::getPerrentCat($value->id);
    		if($value->id == 3){
    			$select_cat = 3;
    		}
    		if($res == "true" AND $select_cat == 3){
    			$cat[] = [
    				'id' => $value->id,
    				'name' => (App::isLocale('ru'))? $value->name_ru : $value->name_uk
    			];
    		}
    	}

        $files = array();

    	return view('cabinet.organization.master.add', compact('org', 'cat', 'filias', 'files', 'teachers'));
    }

    public function addCourseDB(Request $r){
        $this->validate($r, [
            'filia' => 'required',
        ]);

    	Master::addNewMaster($r);

    	return redirect('/' . App::getLocale() . '/cabinet-organization/master');
    }

    public function setStatus(Request $r){
    	$master = Master::where('id', $r->id)->first();
    	if($r->status != 6){
    		$master->status = $r->status;
    		$master->save();
    	}else{
    		master::where('id', $r->id)->delete();
    	}

    	return redirect('/' . App::getLocale() . '/cabinet-organization/master');
    }

    public function edit($lang, $id){
        if(Pack::getPack()['pack'] == 1){
            return redirect(App::getLocale().'/cabinet-organization/payment');
        }
        
    	$master = Master::where('id', $id)->where('user_id', Auth::user()->id)->first();
    	$org = Organization::getStatus();

    	if(!$master){
    		return redirect('/' . App::getLocale() . '/cabinet-organization/master');
    	}

    	if($master->filia){
    		$filias = Filia::getUserFiliaEdit($master->filia);
    	}else{
			$filias = Filia::getUserFilia();
    	}

        if($master->teachers){
            $teachers = Teachers::getUserTeachersEdit($master->teachers);
        }else{
            $teachers = Teachers::getUserTeachers();
        }

    	$categories = Category::getAll_lft();
    	$catAll = new Category();
    	$cat = array();
    	$_cat_current = explode(',', $master->category);
    	$cat_current = Category::where('id', $_cat_current[0])->first();

    	$select_cat = 1;
    	foreach ($categories as $value) {
    		$res = Category::getPerrentCat($value->id);
    		if($value->id == 3){
    			$select_cat = 3;
    		}
    		if($res == "true" AND $select_cat == 3){
    			$cat[] = [
    				'id' => $value->id,
    				'name' => (App::isLocale('ru'))? $value->name_ru : $value->name_uk
    			];
    		}
    	}

    	$page_number = $id;

        $files = File::where('user_id', Auth::user()->id)->where('type', 'master')->where('course_id', $master->id)->orderBy('sort', 'asc')->get();

    	return view('cabinet.organization.master.edit', compact('master', 'cat', 'filias', 'org', 'cat_current', 'page_number', 'files', 'teachers'));
    }

    public function update(Request $r){
    	Master::updateMaster($r);

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
            'type' => 'master',
            'uid' => $request->uid,
        ]);

        $img = File::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        return response()->json(['id' => $img->id, 'path' => $img->img]);
    }

    public function deleteAvatar(Request $r){
        Master::where('id', $r->id)->update(['img' => '/img/default/no-image-mk-main.jpg']);

        return redirect()->back();
    }
}
