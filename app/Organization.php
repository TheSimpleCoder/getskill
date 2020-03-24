<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filia;
use Illuminate\Support\Facades\Auth;
use App;

class Organization extends Model
{
	protected $table = 'organizations';
    protected $fillable = ['user_id', 'name_ru', 'name_ua', 'category_course', 'site_link', 'desc_ru', 'desc_ua', 'url_logo'];

    public function getFilia($r){
    	$id = Self::where('user_id', Auth::user()->id)->first();

    	for ($i=1; $i <= $r->count_fillia ; $i++) {
    		$res = Filia::where('id', $r->get('defaul_id_' . $i))->first();
    		if(!$res){
    			Filia::create([
    				'user_id'         => Auth::user()->id,
    				'organization_id' => $id->id,
    				'city'            => $r->get('regions_' . $i),
    				'address'         => $r->get('dynamic_form_address_' . $i),
    				'phones'          => $r->get('phone-numbers-' . $i),
    				'email'           => $r->get('dynamic_form_email_' . $i),
    				'messanger'       => $r->get('messanger_list_data_' . $i),
    				'active'          => $r->get('switcher_dynamic_' . $i)
    			]);
    		}else{
    			$res->city = $r->get('regions_' . $i);
    			$res->address = $r->get('dynamic_form_address_' . $i);
    			$res->phones = $r->get('phone-numbers-' . $i);
    			$res->email = $r->get('dynamic_form_email_' . $i);
    			$res->messanger = $r->get('messanger_list_data_' . $i);
    			$res->active = ($r->get('switcher_dynamic_' . $i)) ? $r->get('switcher_dynamic_' . $i) : 'off';

    			$res->save();
    		}
    	}

        $regions = Filia::where('organization_id', $id->id)->get();
        $regions_str = ' ';
        foreach ($regions as $val) {
            $regions_str .= $val->city . ', ';
        }
        $id->regions = $regions_str;
        $id->save();
    }

    public static function getStatus(){
        $status = Self::where('user_id', Auth::user()->id)->first();

        return $status;
    }

    public static function getName($id){
        $name = Self::where('id', $id)->first();

        return (App::isLocale('ru'))? $name->name_ru : $name->name_ua;
    }

    public static function getNameAdmin($id){
        $name = Self::where('id', $id)->first();
        $return = $name->name_ru;
        return $return;
    }

    public static function getCountOrgCat($arr_cat){
        $return = array();
        foreach ($arr_cat as $value) {
            $course = Self::where('category_course', 'LIKE', '%' . $value->id . ', %')->count();
            $return[] = [
                'cat' => $value,
                'count' => $course,
            ];
        }

        return $return;
    }

    public static function getList($r, $id){
        $result = Self::where('user_id', '<>', null);

        if($id != 'all'){
            $result = $result->where('category_course', 'LIKE', '% ' . $id . ', %');
        }

        if($r->city_filter){
            $result = $result->where('regions', 'LIKE', '% ' . $r->city_filter . ', %');
        }

        if($r->five_stars_5 == 'on' AND !$r->five_stars_4 AND !$r->five_stars_3 AND !$r->five_stars_2 AND !$r->five_stars_1){
            $result = $result->where('rate', '>=', 5);
        }

        if($r->five_stars_4 == 'on' AND !$r->five_stars_5 AND !$r->five_stars_3 AND !$r->five_stars_2 AND !$r->five_stars_1){
            $result = $result->where('rate', '>=', 4);
            $result = $result->where('rate', '<=', 4.99);
        }

        if($r->five_stars_3 == 'on' AND !$r->five_stars_4 AND !$r->five_stars_5 AND !$r->five_stars_2 AND !$r->five_stars_1){
            $result = $result->where('rate', '>=', 3);
            $result = $result->where('rate', '<=', 3.99);
        }

        if($r->five_stars_2 == 'on' AND !$r->five_stars_4 AND !$r->five_stars_3 AND !$r->five_stars_5 AND !$r->five_stars_1){
            $result = $result->where('rate', '>=', 2);
            $result = $result->where('rate', '<=', 2.99);
        }

        if($r->five_stars_1 == 'on' AND !$r->five_stars_4 AND !$r->five_stars_3 AND !$r->five_stars_2 AND !$r->five_stars_5){
            $result = $result->where('rate', '>=', 0);
            $result = $result->where('rate', '<=', 1.99);
        }

        if($r->five_stars_5 == 'on' AND $r->five_stars_4 == 'on' AND !$r->five_stars_3 AND !$r->five_stars_2 AND !$r->five_stars_1){
            $result = $result->where('rate', '>=', 4);
            $result = $result->where('rate', '<=', 5);
        }

        if($r->five_stars_5 == 'on' AND $r->five_stars_4 == 'on' AND $r->five_stars_3 == 'on' AND !$r->five_stars_2 AND !$r->five_stars_1){
            $result = $result->where('rate', '>=', 3);
            $result = $result->where('rate', '<=', 5);
        }

        if($r->five_stars_5 == 'on' AND $r->five_stars_4 == 'on' AND $r->five_stars_3 == 'on' AND $r->five_stars_2 == 'on' AND !$r->five_stars_1){
            $result = $result->where('rate', '>=', 2);
            $result = $result->where('rate', '<=', 5);
        }

        if($r->five_stars_5 == 'on' AND $r->five_stars_4 == 'on' AND $r->five_stars_3 == 'on' AND $r->five_stars_2 == 'on' AND $r->five_stars_1 == 'on'){
            $result = $result->where('rate', '>=', 0);
            $result = $result->where('rate', '<=', 5);
        }

        if($r->five_stars_4 == 'on' AND $r->five_stars_3 == 'on'){
            $result = $result->where('rate', '>=', 3);
            $result = $result->where('rate', '<=', 4.99);

            var_dump('test test');
        }

        if($r->five_stars_4 == 'on' AND $r->five_stars_3 == 'on' AND $r->five_stars_2 == 'on'){
            $result = $result->where('rate', '>=', 2);
            $result = $result->where('rate', '<=', 4.99);
        }

        if($r->five_stars_4 == 'on' AND $r->five_stars_3 == 'on' AND $r->five_stars_2 == 'on' AND $r->five_stars_1 == 'on'){
            $result = $result->where('rate', '>=', 0);
            $result = $result->where('rate', '<=', 4.99);
        }

        if($r->five_stars_3 == 'on' AND $r->five_stars_2 == 'on'){
            $result = $result->where('rate', '>=', 2);
            $result = $result->where('rate', '<=', 3.99);
        }

        if($r->five_stars_3 == 'on' AND $r->five_stars_2 == 'on' AND $r->five_stars_1 == 'on'){
            $result = $result->where('rate', '>=', 0);
            $result = $result->where('rate', '<=', 3.99);
        }

        if($r->five_stars_2 == 'on' AND $r->five_stars_1 == 'on'){
            $result = $result->where('rate', '>=', 0);
            $result = $result->where('rate', '<=', 2.99);
        }

        $i_new = $result->count();

        $paginate_count = 10;
        switch ($r->order_filter) {
            case 1:
                $result = $result->orderBy('rate', 'desc')->paginate($paginate_count);
                break;
            case 2:
                $result = $result->orderBy('min_price', 'asc')->paginate($paginate_count);
                break;
            case 3:
                $result = $result->orderBy('min_price', 'desc')->paginate($paginate_count);
                break;

            default:
                $result = $result->paginate($paginate_count);
                break;
        }

        $return = ['course' => $result, 'count' => $i_new];
        return $return;
    }

    public static function getCountOrganization(){
        $ret = Self::count();

        return $ret;
    }
}
