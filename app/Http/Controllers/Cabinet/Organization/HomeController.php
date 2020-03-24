<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Publisher\Category\CategoryFormRequest;

use App\Model\Publisher\Category\Entity\Category;
use App\Model\Region\Entity\Region;
use App\Organization;
use App\Filia;
use App\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Auth;
use App;

use Intervention\Image\ImageManagerStatic as Image;


class HomeController extends Controller
{
    public function index()
    {
    	$categories = Category::getAll();
    	$catAll = new Category();
    	$_cat = array();
    	$cat = array();
    	$cat_user = array();

    	foreach ($categories as $value) {
    		$res = $catAll->getPerrentCat($value->id);
    		if($res == "true"){
    			$_cat[] = $value;
    		}
    	}

    	$query = Region::get();
    	$org = Organization::where('user_id', Auth::user()->id)->first();
    	if($org){
    		$filias = Filia::where('organization_id', $org->id)->get();
    		$mass_cat = explode(',', $org->category_course);

    		foreach ($_cat as $value) {
    			$add = false;
    			foreach ($mass_cat as $key) {
    				$in = explode('-', $key);

    				if($value->id == $in[0]){
    					$cat_user[] = [
    						'id'   => $value->id,
    						'name' => (App::isLocale('ru'))? $value->name_ru : $value->name_uk
    					];

    					$add = true;
    					break;
    				}
    			}

    			if($add == false){
    				$cat[] = [
						'id'   => $value->id,
						'name' =>(App::isLocale('ru'))? $value->name_ru : $value->name_uk
					];
    			}
    		}

            $files = File::where('user_id', Auth::user()->id)->where('organization_id', $org->id)->where('type', 'organization')->orderBy('sort')->get();
    	}else{
    		$filias = null;
    		foreach ($_cat as $value) {
    			$cat[] = [
					'id'   => $value->id,
					'name' =>(App::isLocale('ru'))? $value->name_ru : $value->name_uk
				];
    		}
            $files = array();
    	}

        $page_number = '';

        return view('cabinet.organization.home', compact('cat', 'query', 'org', 'filias', 'cat_user', 'page_number', 'files'));
    }

    public function updateOrganization(Request $r){
    	$result = Organization::where('user_id', Auth::user()->id)->first();

    	if($r->file('avatar_organization')){
    		// $path = $r->file('avatar_organization')->store('uploads', 'public', 'org');

            $image = $r->file('avatar_organization');
            $filename = md5(microtime() . rand(0, 9999));

            $image_resize = Image::make($image->getRealPath());
            // resize the image to a width of 210 and constrain aspect ratio (auto height)
            $image_resize->resize(null, 210, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/storage/uploads/' . $filename));
    	}else{
    		$path = null;
            $filename = null;
    	}

        $ct = new Category;

    	if($result == null){
            $cat = '';

            $cat_list = $r->get('cat-list');
            foreach ($cat_list as $val) {
                $check = $ct->checkCatCourse($val);
                $cat .= ', ' . $check . ', ' . $val;
            }
    		Organization::create([
    			'user_id' => Auth::user()->id,
    			'name_ru' => $r->edit_name_ru,
    			'name_ua' => $r->edit_name_ua,
    			'category_course' => $cat,
    			'site_link' => $r->edit_link,
    			'url_logo' => '/storage/uploads/' . $filename,
                'desc_ru' => $r->edit_description_ru,
                'desc_ua' => $r->edit_description_ua,
    		]);
    	}else{
            $cat = '';

			$cat_list = $r->get('cat-list');
            foreach ($cat_list as $val) {
                $check = $ct->checkCatCourse($val);
                $cat .= ', ' . $check . ', ' . $val;
            }
    		$result->name_ru = $r->edit_name_ru;
    		$result->name_ua = $r->edit_name_ua;
    		$result->category_course = ($r->get('cat-list')) ? $cat : $result->category_course;
    		$result->site_link = $r->edit_link;
    		$result->url_logo = ($filename) ? '/storage/uploads/' . $filename : $result->url_logo;
            $result->desc_ru = $r->edit_description_ru;
            $result->desc_ua = $r->edit_description_ua;

    		$result->save();
    	}

    	$fill = new Organization;
    	$fill->getFilia($r);

    	return redirect('/' . App::getLocale() . '/cabinet-organization/info');
    }

    public function uploadPhotoMass(Request $request){
        $org = Organization::where('user_id', Auth::user()->id)->first();
        if(!$org){
            Organization::create([
                'user_id' => Auth::user()->id,
            ]);

            $org = Organization::where('user_id', Auth::user()->id)->first();
        }

        $file = $request->file('file');
        $title = $file->getClientOriginalName();
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
            'title' => $title,
            'img' => '/storage/uploads/' . $filename,
        ]);

        $img = File::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        return response() ->json(['id' => $img->id, 'path' => $img->img]);
    }

    public function dropFiles(Request $r){
        File::where('id', $r->id)->delete();
    }

    public function deleteAvatar (){
        Organization::where('user_id', Auth::user()->id)->update(['url_logo' => '/img/default/no-image-mk-main.jpg']);

        return redirect()->back();
    }

    public function deleteFilia(Request $r){
        Filia::where('id', $r->id)->delete();
    }
}
