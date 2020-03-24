<?php

namespace App\Help;

use Illuminate\Database\Eloquent\Model;
use App;
use App\Master;
use App\File;
use App\Organization;

class Info extends Model
{
    public static function getMonthName($m){
    	$m = (int)$m;
    	switch ($m) {
    		case 1:
    			$return = (App::isLocale('ru'))? 'Январь' : 'Січень';
    			break;
    		case 2:
    			$return = (App::isLocale('ru'))? 'Февраль' : 'Лютий';
    			break;
    		case 3:
    			$return = (App::isLocale('ru'))? 'Март' : 'Березень';
    			break;
    		case 4:
    			$return = (App::isLocale('ru'))? 'Апрель' : 'Квітень';
    			break;
    		case 5:
    			$return = (App::isLocale('ru'))? 'Май' : 'Травень';
    			break;
    		case 6:
    			$return = (App::isLocale('ru'))? 'Июнь' : 'Червень';
    			break;
    		case 7:
    			$return = (App::isLocale('ru'))? 'Июль' : 'Липень';
    			break;
    		case 8:
    			$return = (App::isLocale('ru'))? 'Август' : 'Серпень';
    			break;
    		case 9:
    			$return = (App::isLocale('ru'))? 'Сентябрь' : 'Вересень';
    			break;
    		case 10:
    			$return = (App::isLocale('ru'))? 'Октябрь' : 'Жовтень';
    			break;
    		case 11:
    			$return = (App::isLocale('ru'))? 'Ноябрь' : 'Листопад';
    			break;
    		case 12:
    			$return = (App::isLocale('ru'))? 'Декабрь' : 'Грудень';
    			break;
    		
    	}

    	return $return;
    }

    public static function getMasterPhoto($id){
    	$file = File::where('type', 'master')->where('course_id', $id)->inRandomOrder()->first();

    	if($file){
    		return $file->img;
    	}

    	$master = Master::where('id', $id)->first();
    	return $master->img;
    }

    public static function getOrganizationPhoto($id){
    	$file = File::where('type', 'organization')->where('course_id', $id)->inRandomOrder()->first();

    	if($file){
    		return $file->img;
    	}

    	$master = Organization::where('id', $id)->first();
    	return $master->url_logo;
    }
}
