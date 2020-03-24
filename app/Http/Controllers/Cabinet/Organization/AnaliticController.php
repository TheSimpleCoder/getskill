<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Course;
use Auth;
use Master;

use AnaliticV;

class AnaliticController extends Controller
{
    public function index(Request $r){
    	$courses = Course::select('id', 'view', 'name_ru', 'name_ua')->where('user_id', Auth::user()->id)->where('status', 1)->get();
    	$masters = Master::select('id', 'view', 'name_ru', 'name_ua')->where('user_id', Auth::user()->id)->where('status', 1)->where('date', '>', time())->get();

    	if(isset($r->info)){
    		//Арефмитическии вспомагательные
        	$x2_month = 2629743 * 2;
        	$x2_day = 86400 * 2;
        	$x2_week = 604800 * 2;

    		//Если есть
            switch ($_GET['info']) {
                case 'today':
                    $stat_min = strtotime(date('d.m.Y 00:00:00'));
                    $stat_max = time();

                    $stat_max_last = strtotime(date('d.m.Y 00:00:00'));
                    $stat_min_last = strtotime(date('d.m.Y 00:00:00')) - 86400;
                    break;
                case 'yesterday':
                    $stat_max = strtotime(date('d.m.Y 00:00:00'));
                    $stat_min = strtotime(date('d.m.Y 00:00:00')) - 86400;

                    $stat_max_last = strtotime(date('d.m.Y 00:00:00')) - 86400;
                    $stat_min_last = strtotime(date('d.m.Y 00:00:00')) - $x2_day;
                    break;
                case 'week':
                    $stat_max = time();
                    $stat_min = time() - 604800;

                    $stat_max_last = time() - 604800;
                    $stat_min_last = time() - $x2_week;
                    break;
            }


            $object_v_1 = AnaliticV::where('user_id', Auth::user()->id)->where('time', '>', $stat_min)->where('type', 'course')->groupBy('course');
    		$object_v_2 = AnaliticV::where('user_id', Auth::user()->id)->where('time', '>', $stat_min)->where('type', 'master')->groupBy('course');

    		$object_v_1 = $object_v_1->where('time', '<', $stat_max)->get();
    		$object_v_2 = $object_v_2->where('time', '<', $stat_max)->get();

            $array_1 = array();
    		$array_2 = array();

    		foreach ($object_v_1 as $value) {
    			$array_1[] = $value;
    		}

    		foreach ($object_v_2 as $value) {
    			$array_2[] = $value;
    		}

    		$return_v = array_merge($array_1, $array_2);
    	}else{
    		$time = time() - 2629743;
    		$object_v_1 = AnaliticV::where('user_id', Auth::user()->id)->where('time', '>', $time)->where('type', 'course')->groupBy('course')->get();
    		$object_v_2 = AnaliticV::where('user_id', Auth::user()->id)->where('time', '>', $time)->where('type', 'master')->groupBy('course')->get();

    		$array_1 = array();
    		$array_2 = array();

    		foreach ($object_v_1 as $value) {
    			$array_1[] = $value;
    		}

    		foreach ($object_v_2 as $value) {
    			$array_2[] = $value;
    		}

    		$return_v = array_merge($array_1, $array_2);
    	}

    	return view('cabinet.organization.analitic.index', compact('courses', 'masters', 'return_v', 'r'));
    }
}
