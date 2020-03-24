<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Course;
use Master;
use DB;
use App;
use App\Model\Region\Entity\Region;
use App\Organization;
use App\Module\Search as Se;

class Search extends Controller
{
    public function index(Request $r){
    	$course = Course::where('name_ru', 'LIKE', '%' . $r->search . '%')->orWhere('name_ua', 'LIKE', '%' . $r->search . '%')->limit(5)->get();
    	$master = Master::where('name_ru', 'LIKE', '%' . $r->search . '%')->orWhere('name_ua', 'LIKE', '%' . $r->search . '%')->limit(5)->get();

    	return response()->json(['course' => $course, 'master' => $master]);
    }

    public function page(Request $r){
    	$se = Se::filters($r);
    	$courses = $se['course'];
    	$masters = $se['master'];
    	$show = $se['show'];
    	$regions = Region::get();
    	//Фильтра
    	$_filter_region = (isset($_GET['city_filter']))? $_GET['city_filter'] : '';
        if($_filter_region != ''){
            $filter_region = Region::where('id', $_filter_region)->first();
            $f_region = (App::isLocale('ru'))? $filter_region->name_ru : $filter_region->name_uk;
            $filter_city = (App::isLocale('ru'))? $filter_region->name_ru : $filter_region->name_uk;
        }else{
            $f_region = __(('course/home.Select'));
            $filter_city = null;
        }
        $max_price_master = Master::where('category', 'LIKE', '% 3, %')->where('status', 1)->orderBy('price_about', 'desc')->first();
        $max_price_course = Master::where('category', 'LIKE', '% 1, %')->orWhere('category', 'LIKE', '% 2, %')->where('status', 1)->orderBy('price_about', 'desc')->first();
        $max_price = ($max_price_course > $max_price_master)? $max_price_course : $max_price_master;
        $top_school = DB::table('masters_list')->select('organization_id')->groupBy('organization_id')->get();
        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        $search = $r->search;
    	return view('search', compact('courses', 'masters', 'regions', 'f_region', 'filter_city', 'max_price', 'show', 'schools_top', 'search'));
    }
}
