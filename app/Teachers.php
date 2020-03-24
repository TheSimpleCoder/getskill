<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Organization;
use App;

use Intervention\Image\ImageManagerStatic as Image;


class Teachers extends Model
{
    protected $table = 'teachers';
    protected $fillable = ['user_id', 'organization_id', 'name_ru', 'name_ua', 'desc_ru', 'desc_ua', 'status', 'img'];

    public static function createNew($r){
    	$id = Auth::user()->id;
    	$org = Organization::where('user_id', $id)->first();

    	if($r->file('cabinet_user_avatar')){
    		// $path = $r->file('cabinet_user_avatar')->store('uploads', 'public', 'org');

            $image = $r->file('cabinet_user_avatar');
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

    	Self::create([
    		'user_id' => $id,
    		'organization_id' => $org->id,
    		'name_ru' => $r->edit_teachers_name_ru,
    		'name_ua' => $r->edit_teachers_name_ua,
    		'desc_ru' => $r->edit_teachers_description_ru,
    		'desc_ua' => $r->edit_teachers_description_ua,
    		'status' => 1,
    		'img' => ($r->file('cabinet_user_avatar'))? '/storage/uploads/' . $filename : '/img/default/no-image-teacher.jpg'
    	]);
    }

    public static function updateInfo($r){
    	$res = Self::where('id', $r->id_t)->first();

    	if($r->file('cabinet_user_avatar')){
    		// $path = $r->file('cabinet_user_avatar')->store('uploads', 'public', 'org');

            $image = $r->file('cabinet_user_avatar');
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

    	$res->name_ru = $r->edit_teachers_name_ru;
    	$res->name_ua = $r->edit_teachers_name_ua;
    	$res->desc_ru = $r->edit_teachers_description_ru;
    	$res->desc_ua = $r->edit_teachers_description_ua;
    	$res->img = ($filename)? '/storage/uploads/' . $filename : $res->img;

    	$res->save();
    }

    public static function getUserTeachers(){
        $id = Auth::user()->id;
        $result = Self::where('user_id', $id)->orderBy('id', 'asc')->get();

        if(!$result){
            return $result;
        }

        $res = array();
        foreach ($result as $key) {
            $res[] = [
                'id' => $key->id,
                'name' => (App::isLocale('ru'))? $key->name_ru : $key->name_ua,
                'show' => 'false'
            ];
        }

        return $res;
    }

    public static function getUserTeachersEdit($f){
        $id = Auth::user()->id;
        $result = Self::where('user_id', $id)->orderBy('id', 'asc')->get();

        $res = array();
        $_f = explode(',', $f);
        foreach ($result as $key) {
            if(!array_search($key->id, $_f)){
                $show = 'true';
            }else{
                $show = 'false';
            }
            $res[] = [
                'id' => $key->id,
                'name' => (App::isLocale('ru'))? $key->name_ru : $key->name_ua,
                'show' => $show
            ];
            
        }

        return $res;
    }
}
