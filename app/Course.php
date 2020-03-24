<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Organization;
use App\Filia;
use App\Model\Category\Entity\Category;
use App;
use App\Model\Region\Entity\Region;
use App\File;

use Intervention\Image\ImageManagerStatic as Image;

class Course extends Model
{
	protected $table = 'course_list';
    protected $fillable = ['user_id', 'organization_id', 'name_ru', 'name_ua', 'type', 'category', 'price_course', 'price_about', 'currency', 'od', 'sale', 'price', 'teachers', 'filia', 'regions', 'finish', 'group_info', 'test_train', 'desc_ru', 'desc_ua', 'logo_course'];

    public static function addCourse($r){
    	$id = Auth::user()->id;
    	$org = Organization::where('user_id', $id)->first();
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
    		$about = $r->add_curse_price;
    	}elseif($r->currency == 2){
			$about = $r->add_curse_price * 23;
    	}else{
    		$about = $r->add_curse_price * 25;
    	}

        $check = $ct->checkCatCourse($r->category);
        $cat = ' ' . $r->category . ', ' . $check;
        for ($i = 0; $i < 100; $i++) {
            if($check == 'null'){
                break;
            }else{
                $check = $ct->checkCatCourse($check);
                $cat .= ', '.$check;
            }
        }

        $_regions = explode(',', $r->filia);
        $regions = '';
        foreach ($_regions as $key) {
            if($key){
                var_dump($key);
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
    		'category'        => $cat,
    		'price_course'    => $r->add_curse_price,
    		'price_about'     => $about,
    		'currency'        => $r->currency,
    		'od'              => $r->od,
    		'sale'            => $r->sale,
    		'price'           => $r->organization_curse_add_price_details,
    		'teachers'        => $r->teachers,
    		'filia'           => $r->filia,
            'regions'         => $regions,
    		'finish'          => $r->cert,
    		'group_info'      => $r->group,
    		'test_train'      => $r->test_train,
    		'desc_ru'         => $r->edit_description_ru,
    		'desc_ua'         => $r->edit_description_ua,
    		'logo_course'     => ($r->file('add_curse_main_logo'))? '/storage/uploads/' . $filename : '/img/default/no-image-course.jpg',
    	]);

        $course = Self::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
        File::where('uid', $r->uid)->update(['course_id' => $course->id]);

        if($org->min_price > $about OR $org->min_price == 0){
            $org->min_price = $about;
            $org->save();
        }
    }

    public static function updateCourse($r){
    	$self = Self::where('id', $r->id)->first();
        $ct = new Category;
        $org = Organization::where('id', $self->organization_id)->first();

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
    		$about = $r->add_curse_price;
    	}elseif($r->currency == 2){
			$about = $r->add_curse_price * 23;
    	}else{
    		$about = $r->add_curse_price * 25;
    	}

        $check_edit = explode(',', $r->category);
        $check = $ct->checkCatCourse($check_edit[0]);
		
        $cat = ' ' . $r->category . ', ' . $check;
        for ($i = 0; $i < 100; $i++) {
            if($check == 'null'){
                break;
            }else{
                $check = $ct->checkCatCourse($check);
                $cat .= ', '.$check;
            }
        }

        $_regions = explode(',', $r->filia);
        $regions = '';
        foreach ($_regions as $key) {
            if($key){
                var_dump($key);
                $region = Filia::where('id', $key)->first();
                $regions .= $region->city;
            }
        }

    	$self->name_ru = $r->edit_name_ru;
    	$self->name_ua = $r->edit_name_ua;
    	$self->type = $r->type_online;
    	$self->category = $r->category;
    	$self->price_course = $r->add_curse_price;
    	$self->price_about = $about;
    	$self->currency = $r->currency;
    	$self->od = $r->od;
    	$self->sale = $r->sale;
    	$self->price = $r->organization_curse_add_price_details;
    	$self->teachers = $r->teachers;
    	$self->filia = $r->filia;
        $self->regions = $regions;
    	$self->finish = $r->cert;
    	$self->group_info = $r->group;
    	$self->test_train = $r->test_train;
    	$self->desc_ru = $r->edit_description_ru;
    	$self->desc_ua = $r->edit_description_ua;
    	$self->logo_course = ($filename)? '/storage/uploads/' . $filename : $self->logo_course;
        $self->status = 0;

    	$self->save();

        if($org->min_price > $about OR $org->min_price == 0){
            $org->min_price = $about;
            $org->save();
        }
    }

    public static function getList($r, $id){
    	$result = Self::where('status', 1);

        if($id != 'all'){
            $result = $result->where('category', 'LIKE', '% ' . $id . ', %');
        }


        if(isset($r->city_filter)){
            $result = $result->where('regions', $r->city_filter);
        }

    	if($r->group_filter_2 != null AND $r->group_filter_1 == null){
    		$result = $result->where(['group_info' => $r->group_filter_2]);
    	}

        if($r->group_filter_1 != null AND $r->group_filter_2 == null){
            $result = $result->where(['group_info' => $r->group_filter_1]);
        }

    	if($r->cert_filter_1 != null AND $r->cert_filter_2 == null AND $r->cert_filter_3 == null){
    		$result = $result->where(['finish' => $r->cert_filter_1]);
    	}

        if($r->cert_filter_1 != null AND $r->cert_filter_2 != null AND $r->cert_filter_3 == null){
            $result = $result->where('finish', '<>', 3);
        }

        if($r->cert_filter_1 != null AND $r->cert_filter_2 == null AND $r->cert_filter_3 != null){
            $result = $result->where('finish', '<>', 2);
        }

        if($r->cert_filter_1 == null AND $r->cert_filter_2 != null AND $r->cert_filter_3 == null){
            $result = $result->where(['finish' => 2]);
        }

        if($r->cert_filter_1 == null AND $r->cert_filter_2 != null AND $r->cert_filter_3 != null){
            $result = $result->where('finish', '<>', 1);
        }

        if($r->cert_filter_1 == null AND $r->cert_filter_2 == null AND $r->cert_filter_3 != null){
            $result = $result->where('finish', 3);
        }

        if($r->cert_filter_1 == null AND $r->cert_filter_2 == null AND $r->cert_filter_3 != null){
            $result = $result->where('finish', 3);
        }

    	if($r->filter_min_price){
    		$result = $result->where('price_about', '>=', $r->filter_min_price);
    	}

    	if($r->filter_max_price){
    		$result = $result->where('price_about', '<=', $r->filter_max_price);
    	}

        $i_new = $result->count();
        $paginate_count = 12;

        switch ($r->order_filter) {
            case 1:
                $result = $result->orderBy('rait', 'desc')->paginate($paginate_count);
                break;
            case 2:
                $result = $result->orderBy('price_about', 'asc')->paginate($paginate_count);
                break;
            case 3:
                $result = $result->orderBy('price_about', 'desc')->paginate($paginate_count);
                break;

            default:
                $result = $result->paginate($paginate_count);
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
            $course = Self::where('category', 'LIKE', '% ' . $value->id . ', %')->where('status', 1)->count();
            $return[] = [
                'cat' => $value,
                'count' => $course,
            ];
        }

        return $return;
    }

    public static function getCountCourseCatFirst($id){

        $courses = Self::where('category', 'LIKE', '% ' . $id . ', %')->where('status', 1)->count();

        return $courses;
            
    }

    public static function getCurrentCourseWhere($id){
        $self = Self::where('id', $id)->first();

        return $self;
    }

    public static function minPrice($id){
        $res = Self::where('organization_id', $id)->orderBy('price_about', 'asc')->first();
        $self = $res['price_course'];

        return $self;
    }

    public static function getSaleCourse($id){
        $self = Self::where('id', $id)->first();

        $one_procent = $self->price_course / 100;
        $new_price = $self->sale / $one_procent;
        $return = 100 - $new_price;

        return round($return);
    }

    public static function getTopCourse($arr, $id, $f_city = null){
        $return = array();
        foreach ($arr as $key) {
            $res = Self::where('status', 1)->where('user_id', $key->user_id)->inRandomOrder()->first();
			
			if($res){
                $return[] = $res;
            }
        }

        return $return;
    }

    public static function getCourseCountOrganization($id){
        $ret = Self::where('organization_id', $id)->where('status', 1)->count();

        return $ret;
    }

    public static function getNameCourse($id){
        $self = Self::where('id', $id)->first();

        if(!$self){
            return 'contionue';
        }

        (App::isLocale('ru'))? $name = $self->name_ru : $name = $self->name_ua;
        return $name;
    }

    public static function getCountRegion($id){
        $ret = Self::where('regions', $id)->where('status', 1)->count();

        return $ret;
    }

}
