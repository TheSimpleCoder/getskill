<?php

namespace App\Module;

use Illuminate\Database\Eloquent\Model;
use Course;
use Master;

class Search extends Model
{
    public static function filters($data){

    	$cr = 0;
    	$mr = 0;
    	$masters = array();
    	$courses = array();
    	if(isset($data->filter_course_online) OR isset($data->filter_course_offline)){
    		$course_result = Course::where('status', 1);

   			$course_result = Self::selfFilter($course_result, $data);

    		if(isset($data->filter_course_online) AND isset($data->filter_course_offline)){
	    		$course_result = $course_result->where('name_ru', 'LIKE', '%' . $data->search . '%')->orWhere('name_ua', 'LIKE', '%' . $data->search . '%');
	    	}

	    	if(isset($data->filter_course_online) AND !isset($data->filter_course_offline)){
	    		$course_result = $course_result->where('category', 'LIKE', '% 1, %')->where('name_ru', 'LIKE', '%' . $data->search . '%')->orWhere('name_ua', 'LIKE', '%' . $data->search . '%')->where('category', 'LIKE', '% 1, %');
	    	}

	    	if(!isset($data->filter_course_online) AND isset($data->filter_course_offline)){
	    		$course_result = $course_result->where('category', 'LIKE', '% 2, %')->where('name_ru', 'LIKE', '%' . $data->search . '%')->orWhere('name_ua', 'LIKE', '%' . $data->search . '%')->where('category', 'LIKE', '% 2, %');
	    	}

	    	$course_result = Self::selfFilter($course_result, $data);

	    	$cr = $course_result->count();
    	}

    	if(isset($data->filter_course_master)){
    		$master_result = Master::where('status', 1);
    		$master_result = Self::selfFilterMaster($master_result, $data);

    		$master_result = $master_result->where('name_ru', 'LIKE', '%' . $data->search . '%')->orWhere('name_ua', 'LIKE', '%' . $data->search . '%');

    		$master_result = Self::selfFilterMaster($master_result, $data);

    		$masters = $master_result->get();
    		$mr = $master_result->count();
    	}

        if(!isset($data->filter_course_online) AND !isset($data->filter_course_offline) AND !isset($data->filter_course_master)){
            $course_result = Course::where('status', 1);

            $course_result = Self::selfFilter($course_result, $data);

            if(isset($data->filter_course_online) AND isset($data->filter_course_offline)){
                $course_result = $course_result->where('name_ru', 'LIKE', '%' . $data->search . '%')->orWhere('name_ua', 'LIKE', '%' . $data->search . '%');
            }

            if(isset($data->filter_course_online) AND !isset($data->filter_course_offline)){
                $course_result = $course_result->where('category', 'LIKE', '% 1, %')->where('name_ru', 'LIKE', '%' . $data->search . '%')->orWhere('name_ua', 'LIKE', '%' . $data->search . '%')->where('category', 'LIKE', '% 1, %');
            }

            if(!isset($data->filter_course_online) AND isset($data->filter_course_offline)){
                $course_result = $course_result->where('category', 'LIKE', '% 2, %')->where('name_ru', 'LIKE', '%' . $data->search . '%')->orWhere('name_ua', 'LIKE', '%' . $data->search . '%')->where('category', 'LIKE', '% 2, %');
            }

            $course_result = Self::selfFilter($course_result, $data);

            $cr = $course_result->count();

            $master_result = Master::where('status', 1);
            $master_result = Self::selfFilterMaster($master_result, $data);

            $master_result = $master_result->where('name_ru', 'LIKE', '%' . $data->search . '%')->orWhere('name_ua', 'LIKE', '%' . $data->search . '%');

            $master_result = Self::selfFilterMaster($master_result, $data);

            $masters = $master_result->get();
            $mr = $master_result->count();
        }

    	if(isset($course_result)){
    		$courses = $course_result->paginate(16);
    	}

    	$show = $cr + $mr;


    	$return = [
    		'course' => $courses,
    		'master' => $masters,
    		'show' => $show
    	];
    	return $return;
    }

    public static function selfFilter($course_result, $data){
    	if(isset($data->type_course_1) AND !isset($data->type_course_2)){
			$course_result = $course_result->where('group_info', 1);
		}

		if(!isset($data->type_course_1) AND isset($data->type_course_2)){
			$course_result = $course_result->where('group_info', 2);
		}

		if($data->cert_filter_1 != null AND $data->cert_filter_2 == null AND $data->cert_filter_3 == null){
    		$course_result = $course_result->where(['finish' => $data->cert_filter_1]);
    	}

        if($data->cert_filter_1 != null AND $data->cert_filter_2 != null AND $data->cert_filter_3 == null){
            $course_result = $course_result->where('finish', '<>', 3);
        }

        if($data->cert_filter_1 != null AND $data->cert_filter_2 == null AND $data->cert_filter_3 != null){
            $course_result = $course_result->where('finish', '<>', 2);
        }

        if($data->cert_filter_1 == null AND $data->cert_filter_2 != null AND $data->cert_filter_3 == null){
            $course_result = $course_result->where(['finish' => 2]);
        }

        if($data->cert_filter_1 == null AND $data->cert_filter_2 != null AND $data->cert_filter_3 != null){
            $course_result = $course_result->where('finish', '<>', 1);
        }

        if($data->cert_filter_1 == null AND $data->cert_filter_2 == null AND $data->cert_filter_3 != null){
            $course_result = $course_result->where('finish', 3);
        }

        if($data->cert_filter_1 == null AND $data->cert_filter_2 == null AND $data->cert_filter_3 != null){
            $course_result = $course_result->where('finish', 3);
        }

        if($data->filter_min_price){
    		$course_result = $course_result->where('price_about', '>=', $data->filter_min_price);
    	}

    	if($data->filter_max_price){
    		$course_result = $course_result->where('price_about', '<=', $data->filter_max_price);
    	}

    	if(isset($data->city_filter)){
    		$course_result = $course_result->where('regions', $data->city_filter);
    	}

		$course_result = $course_result->where('status', 1);

		if($data->order_filter){
			switch ($data->order_filter) {
	            case 1:
	                $course_result = $course_result->orderBy('rait', 'desc');
	                break;
	            case 2:
	                $course_result = $course_result->orderBy('price_about', 'asc');
	                break;
	            case 3:
	                $course_result = $course_result->orderBy('price_about', 'desc');
	                break;
	        }
		}

		return $course_result;
    }

    public static function selfFilterMaster($master_result, $data){
    	if(isset($data->group_filter_1) AND !isset($data->group_filter_2)){
    		$master_result = $master_result->where('type', 1);
    	}

    	if(!isset($data->group_filter_1) AND isset($data->group_filter_2)){
    		$master_result = $master_result->where('type', 2);
    	}

    	if($data->cert_filter_1 != null AND $data->cert_filter_3 == null){
            $master_result = $master_result->where(['finish' => $data->cert_filter_1]);
        }

        if($data->cert_filter_1 == null AND $data->cert_filter_3 != null){
            $master_result = $master_result->where(['finish' => 2]);
        }

        if($data->date_filter_1){
            $date = strtotime($data->date_filter_1);
            $master_result = $master_result->where('date', '>=', $date);
        }

        if($data->date_filter_2){
            $date_2 = strtotime($data->date_filter_2);
            $master_result = $master_result->where('date', '<=', $date_2);
        }

    	if($data->filter_min_price){
    		$master_result = $master_result->where('price_about', '>=', $data->filter_min_price);
    	}

    	if($data->filter_max_price){
    		$master_result = $master_result->where('price_about', '<=', $data->filter_max_price);
    	}

    	if(isset($data->city_filter)){
    		$master_result = $master_result->where('regions', $data->city_filter);
    	}

    	if($data->order_filter){
			switch ($data->order_filter) {
	            case 1:
	                $master_result = $master_result->orderBy('rait', 'desc');
	                break;
	            case 2:
	                $master_result = $master_result->orderBy('price_about', 'asc');
	                break;
	            case 3:
	                $master_result = $master_result->orderBy('price_about', 'desc');
	                break;
	        }
		}

		$master_result = $master_result->where('status', 1);

		return $master_result;
    }
}
