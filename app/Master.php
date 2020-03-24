<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Organization;
use App\Filia;
use App\Model\Category\Entity\Category;
use App;
use App\Model\Region\Entity\Region;

use Intervention\Image\ImageManagerStatic as Image;


class Master extends Model
{
    protected $table = 'masters_list';
    protected $fillable = ['user_id', 'organization_id', 'name_ru', 'name_ua', 'type', 'category', 'price', 'currency', 'price_about', 'price_type', 'date','teachers', 'filia', 'regions', 'finish', 'desc_ru', 'desc_ua', 'img'];

    public static function addNewMaster($r){
    	$id = Auth::user()->id;
    	$org = Organization::where('user_id', $id)->first();
        $ct = new Category;

        if($r->file('add_curse_main_logo')){
    		$path = $r->file('add_curse_main_logo')->store('uploads', 'public', 'org');

            $image = $r->file('add_curse_main_logo');
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

    	if($r->currency == 1){
    		$about = $r->price;
    	}elseif($r->currency == 2){
			$about = $r->price * 23;
    	}else{
    		$about = $r->price * 25;
    	}

    	$check = $ct->checkCatCourse($r->category);
		
		$catList = "";
		foreach($r->category as $c)
		{
			$catList .= "$c,";
		}
		$catList = mb_substr($catList, 0, -1);
		
		
        // $cat = $r->category . ',' . $check;
        // for ($i = 0; $i < 100; $i++) {
            // if($check == 'null'){
                // break;
            // }else{
                // $check = $ct->checkCatCourse($check);
                // $cat .= ', '.$check;
            // }
        // }

        $_regions = explode(',', $r->filia);
        $regions = '';
        foreach ($_regions as $key) {
            if($key){
                $region = Filia::where('id', $key)->first();
                $regions .= $region->city;
            }
        }

        Self::create([
    		'user_id'         => $id,
    		'organization_id' => $org->id,
    		'name_ru'         => $r->edit_name_ru,
    		'name_ua'         => $r->edit_name_ua,
    		'type'            => $r->type_online,
    		'category'        => $catList,
    		'price'           => $r->price,
    		'price_about'     => $about,
    		'currency'        => $r->currency,
    		'price_type'      => $r->organization_curse_add_price_details,
    		'date'            => strtotime($r->date),
    		'teachers'        => $r->teachers,
    		'filia'           => $r->filia,
            'regions'         => $regions,
    		'finish'          => $r->cert,
    		'desc_ru'         => $r->edit_description_ru,
    		'desc_ua'         => $r->edit_description_ua,
    		'img'             => ($r->file('add_curse_main_logo'))? '/storage/uploads/' . $filename : '/img/default/no-image-mk-main.jpg',
    	]);
    }

    public static function updateMaster($r){
    	$self = Self::where('id', $r->id)->first();
        $ct = new Category;

    	if($r->file('add_curse_main_logo')){
    		// $path = $r->file('add_curse_main_logo')->store('uploads', 'public', 'org');

            $image = $r->file('add_curse_main_logo');
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

    	if($r->currency == 1){
    		$about = $r->price;
    	}elseif($r->currency == 2){
			$about = $r->price * 23;
    	}else{
    		$about = $r->price * 25;
    	}

        $check_edit = explode(',', $r->category);
        $check = $ct->checkCatCourse($check_edit[0]);
        $cat = $r->category . ',' . $check;
        for ($i = 0; $i < 100; $i++) {
            if($check == 'null'){
                break;
            }else{
                $check = $ct->checkCatCourse($check);
                $cat .= ', '.$check;
            }
        }

		
		$filiasList = "";
		$regions = '';
		foreach($r->filia as $fil)
		{
			$region = Filia::where('id', $fil)->first();
            $regions .= $region->city;
			
			$filiasList .= "$fil,";
		}
		$filiasList = mb_substr($filiasList, 0, -1);

        // $_regions = explode(',', $r->filia);
        // $regions = '';
        // foreach ($_regions as $key) {
            // if($key){
                // $region = Filia::where('id', $key)->first();
                // $regions .= $region->city;
            // }
        // }

    	$self->name_ru = $r->edit_name_ru;
    	$self->name_ua = $r->edit_name_ua;
    	$self->type = $r->type_online;
    	$self->category = $cat;
    	$self->price = $r->price;
    	$self->price_about = $about;
    	$self->currency = $r->currency;
    	$self->price_type = $r->organization_curse_add_price_details;
    	$self->teachers = $r->teachers;
    	$self->filia = $filiasList;
        $self->regions = $regions;
    	$self->finish = $r->cert;
    	$self->desc_ru = $r->edit_description_ru;
    	$self->desc_ua = $r->edit_description_ua;
    	$self->img = ($filename)? '/storage/uploads/' . $filename : $self->img;
    	$self->date = strtotime($r->date);
        $self->status = 0;

    	$self->save();
    }

    public static function getList($r, $id){
    	$result = Self::where('status', 1);

        if($id != 'all'){
            $result = $result->where('category', 'LIKE', '%' . $id . ', %');
        }

    	if($r->group_filter_2 != null AND $r->group_filter_1 == null){
            $result = $result->where(['type' => $r->group_filter_2]);
        }

        if($r->group_filter_1 != null AND $r->group_filter_2 == null){
            $result = $result->where(['type' => $r->group_filter_1]);
        }

        if($r->cert_filter_1 != null AND $r->cert_filter_2 == null){
            $result = $result->where(['finish' => $r->cert_filter_1]);
        }

        if($r->cert_filter_1 == null AND $r->cert_filter_2 != null){
            $result = $result->where(['finish' => $r->cert_filter_2]);
        }

        if($r->date_filter_1){
            $date = strtotime($r->date_filter_1);
            $result = $result->where('date', '>=', $date);
        }

        if($r->date_filter_2){
            $date_2 = strtotime($r->date_filter_2);
            $result = $result->where('date', '<=', $date_2);
        }

    	if($r->filter_min_price){
    		$result = $result->where('price_about', '>=', $r->filter_min_price);
    	}

    	if($r->filter_max_price){
    		$result = $result->where('price_about', '<=', $r->filter_max_price);
    	}

        $i_new = $result->count();

        switch ($r->order_filter) {
            case 1:
                $result = $result->orderBy('rait', 'desc')->paginate(20);
                break;
            case 2:
                $result = $result->orderBy('price_about', 'asc')->paginate(20);
                break;
            case 3:
                $result = $result->orderBy('price_about', 'desc')->paginate(20);
                break;

            default:
                $result = $result->paginate(20);
                break;
        }

    	$return = ['course' => $result, 'count' => $i_new];
    	return $return;
    }

    public static function getListNoneFilter($region, $id){
        $result = Self::where('status', 1);

        if($region != 'ukraina' AND $region != 52){
            $result = $result->where('regions', $region);
        }

        $result = $result->where('category', 'LIKE', '% ' . $id . ', %')->paginate(20);

        return $result;
    }

    public static function getCountCourseCat($arr_cat){
        $return = array();
        foreach ($arr_cat as $value) {
            $course = Self::where('category', 'LIKE', '%' . $value->id . ', %')->where('status', 1)->count();
            $return[] = [
                'cat' => $value,
                'count' => $course,
            ];
        }

        return $return;
    }

    public static function getNameMaster($id){
        $self = Self::where('id', $id)->first();

        if(!$self){
            return 'contionue';
        }

        (App::isLocale('ru'))? $name = $self->name_ru : $name = $self->name_ua;
        return $name;
    }

    public static function getCountMasterCatFirst($id, $slug){

        if($slug != null){
            $region = Region::where('slug', $slug)->first();
            $courses = Self::where('category', 'LIKE', '% ' . $id . ', %')->where('status', 1)->where('date', '>', time())->where('regions', $region->id)->count();
            return $courses;
        }
        
        $courses = Self::where('category', 'LIKE', '% ' . $id . ', %')->where('status', 1)->where('date', '>', time())->count();

        return $courses;
            
    }
}
