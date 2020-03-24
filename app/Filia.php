<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App;
use App\Model\Region\Entity\Region;

class Filia extends Model
{
    protected $table = 'filias';
    
    protected $fillable = ['user_id', 'organization_id', 'city', 'address', 'phones', 'email', 'messanger'];

    public static function getUserFilia(){
        $id = Auth::user()->id;
        $result = Self::where('user_id', $id)->where('active', 'on')->orderBy('id', 'asc')->get();

        if(!$result){
            return $result;
        }

        $res = array();
        foreach ($result as $key) {
            $city = Region::where('id', $key->city)->first();
            $res[] = [
                'id' => $key->id,
                'name' => (App::isLocale('ru'))? $city->name_ru . ', ' . $key->address : $city->name_uk . ', ' . $key->address
            ];
        }

        return $res;
    }

    public static function getUserFiliaEdit($f){
        $id = Auth::user()->id;
        $result = Self::where('user_id', $id)->where('active', 'on')->orderBy('id', 'asc')->get();

        $res = array();
        $_f = explode(',', $f);
		
        foreach ($result as $key) {

            if(in_array($key->id, $_f)){
                $show = 'true';
            }else{
                $show = 'false';
            }
            $city = Region::where('id', $key->city)->first();
            $res[] = [
                'id' => $key->id,
                'name' => (App::isLocale('ru'))? $city->name_ru . ', ' . $key->address : $city->name_uk . ', ' . $key->address,
                'show' => $show
            ];
            
        }

        return $res;
    }

    //Функция обрабатывает все регионы привязанные к курсу
    public static function gatNameRegionForCourse($str){
        $ex = explode(',', $str);

        $new_ex = array_diff($ex, array(''));
        if(count($new_ex) > 0){
            $nm = Region::where('id', $new_ex[0])->first();
            if($nm){
                $return = (App::isLocale('ru'))? $nm->name_ru : $nm->name_uk;
            }else{
                $return = '';
            }
        }else{
            $return = '';
        }
        
        return $return;
    }

    public static function getCountRegionsCourse($str){
        $ex = explode(',', $str);

        $new_ex = array_diff($ex, array(''));
        $count = count($new_ex) - 1;
        if($count > 0){
            $return = (App::isLocale('ru'))? 'еще ' . $count . ' города' : 'ще ' . $count . ' мiста';
        }else{
            $return = '';
        }

        return $return;
    }

    //Функция обрабатывает все регионы привязанные к школе
    public static function gatNameRegionForSchool($str){
        $region = Self::where('organization_id', $str)->first();
        if($region){
           $nm = Region::where('id', $region->city)->first();
           $return = (App::isLocale('ru'))? $nm->name_ru : $nm->name_uk;
        }else{
            $return = '';
        }
        
        return $return;
    }

    public static function getCountRegionsSchool($str){
        $region = Self::where('organization_id', $str)->count();

        $count = $region - 1;
        if($count > 0){
            $return = (App::isLocale('ru'))? 'еще ' . $count . ' города' : 'ще ' . $count . ' мiста';
        }else{
            $return = '';
        }

        return $return;
    }
}
