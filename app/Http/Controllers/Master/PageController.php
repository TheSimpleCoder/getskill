<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Master;
use App\Model\Category\Entity\Category;
use App;
use App\Model\Region\Entity\Region;
use Illuminate\Pagination\Paginator;
use App\Organization;
use App\Teachers;
use App\Filia;
use App\Reviews;
use DB;
use App\File;
use AnaliticV;

class PageController extends Controller
{
    public function index_stage_2(Request $r, $local, $cat_stage_1, $cat_stage_2){
        $cat_sel = Category::where('slug', $cat_stage_2)->first();
        if($cat_stage_1 == 'all'){
            $id = 'all';
        }else{
            $id = $cat_sel->id;
        }
    	$count = Master::where('category', 'LIKE', '% 3, %')->where('status', 1)->count();
    	$current_cat =  Category::where('id', $id)->first();
        $regions = Region::get();
        $max_price = Master::where('category', 'LIKE', '% 3, %')->where('status', 1)->orderBy('price_about', 'desc')->first();
        if(!$max_price){
            $max_price = (object)array('price_about' => 0);
        }
        $show = 0;
        $desc = '';

        if($id == 'all'){
            $_description = (App::islocale('ru'))? 'Мастер-классы' : 'мастер-класи';
            $_keywords = (App::islocale('ru'))? 'Мастер-классы' : 'мастер-класи';
            $t = '';
            $cat_id = 3;
            $meta_title = (App::islocale('ru'))? 'Мастер-классы' : 'мастер-класи';
        }else{
        	$_t = Category::where('id', $id)->first();
            $_description = (App::isLocale('ru'))? $current_cat->meta_description_ru : $current_cat->meta_description_uk;
            $_keywords = (App::isLocale('ru'))? $current_cat->meta_keywords_ru : $current_cat->meta_keywords_uk;
            $t = (App::isLocale('ru'))? $current_cat->name_ru : $current_cat->name_uk;
            $cat_id = $id;
            $desc = (App::isLocale('ru'))? $current_cat->description_ru : $current_cat->description_uk;
            $meta_title = (App::isLocale('ru'))? $_t->meta_title_ru : $_t->meta_title_uk;
        }

        $categorys = Category::where('parent_id', $cat_id)->get();
        if(!$categorys){
            $categorys = Category::where('id', $cat_id)->get();
            
        }
        $categorys_count = Master::getCountCourseCat($categorys);

        $_filter_region = (isset($_GET['city_filter']))? $_GET['city_filter'] : '';
        //Фильтра
        if($_filter_region != ''){
            $filter_region = Region::where('id', $_filter_region)->first();
            $f_region = (App::isLocale('ru'))? $filter_region->name_ru : $filter_region->name_uk;
            $filter_city = (App::isLocale('ru'))? $filter_region->name_ru : $filter_region->name_uk;
        }else{
            $f_region = __(('course/home.Select'));
            $filter_city = null;
        }

        if($r->grop_filter){
            $filter_group = ($r->grop_filter == 1)? (App::isLocale('ru'))? 'В группе' : 'В групi' : (App::isLocale('ru'))? 'Идивидульно' : 'Iндивiдуально';
        }else{
            $filter_group = null;
        }

        if($r->cert_filter){
            if($r->cert_filter == 1){
                $filter_cert = (App::isLocale('ru'))? 'Сертификат' : 'Сертифiкат';
            }elseif ($r->cert_filter == 2) {
                $filter_cert = 'Диплом';
            }else{
                $filter_cert = (App::isLocale('ru'))? 'Нет' : 'Нi';
            }
        }else{
            $filter_cert = null;
        }

        $_lists = Master::getList($r, $cat_id);
        $lists = $_lists['course'];
        $show = $_lists['count'];

        $top_school = DB::table('masters_list')->select('organization_id')->groupBy('organization_id')->limit(10)->get();
        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }

        return view('master.index', compact('t', '_description', '_keywords', 'categorys_count', 'f_region', 'regions', 'max_price', 'show', 'lists', 'count', 'filter_city', 'filter_group', 'filter_cert', 'desc', 'schools_top', 'id', 'meta_title', 'cat_stage_1', 'cat_stage_2'));
    }

    public function index_stage_3(Request $r, $local, $cat_stage_1, $cat_stage_2, $cat_stage_3){
        $cat_sel = Category::where('slug', $cat_stage_3)->first();
        if($cat_stage_1 == 'all'){
            $id = 'all';
        }else{
            $id = $cat_sel->id;
        }
    	$count = Master::where('category', 'LIKE', '% 3, %')->where('status', 1)->count();
    	$current_cat =  Category::where('id', $id)->first();
        $regions = Region::get();
        $max_price = Master::where('category', 'LIKE', '% 3, %')->where('status', 1)->orderBy('price_about', 'desc')->first();
        if(!$max_price){
            $max_price = (object)array('price_about' => 0);
        }
        $show = 0;
        $desc = '';

        if($id == 'all'){
            $_description = (App::islocale('ru'))? 'Мастер-классы' : 'мастер-класи';
            $_keywords = (App::islocale('ru'))? 'Мастер-классы' : 'мастер-класи';
            $t = '';
            $cat_id = 3;
            $meta_title = (App::islocale('ru'))? 'Мастер-классы' : 'мастер-класи';
        }else{
        	$_t = Category::where('id', $id)->first();
            $_description = (App::isLocale('ru'))? $current_cat->meta_description_ru : $current_cat->meta_description_uk;
            $_keywords = (App::isLocale('ru'))? $current_cat->meta_keywords_ru : $current_cat->meta_keywords_uk;
            $t = (App::isLocale('ru'))? $current_cat->name_ru : $current_cat->name_uk;
            $cat_id = $id;
            $desc = (App::isLocale('ru'))? $current_cat->description_ru : $current_cat->description_uk;
            $meta_title = (App::isLocale('ru'))? $_t->meta_title_ru : $_t->meta_title_uk;
        }

        $categorys = Category::where('parent_id', $cat_id)->get();
        if(!$categorys){
            $categorys = Category::where('id', $cat_id)->get();
            
        }
        $categorys_count = Master::getCountCourseCat($categorys);

        $_filter_region = (isset($_GET['city_filter']))? $_GET['city_filter'] : '';
        //Фильтра
        if($_filter_region != ''){
            $filter_region = Region::where('id', $_filter_region)->first();
            $f_region = (App::isLocale('ru'))? $filter_region->name_ru : $filter_region->name_uk;
            $filter_city = (App::isLocale('ru'))? $filter_region->name_ru : $filter_region->name_uk;
        }else{
            $f_region = __(('course/home.Select'));
            $filter_city = null;
        }

        if($r->grop_filter){
            $filter_group = ($r->grop_filter == 1)? (App::isLocale('ru'))? 'В группе' : 'В групi' : (App::isLocale('ru'))? 'Идивидульно' : 'Iндивiдуально';
        }else{
            $filter_group = null;
        }

        if($r->cert_filter){
            if($r->cert_filter == 1){
                $filter_cert = (App::isLocale('ru'))? 'Сертификат' : 'Сертифiкат';
            }elseif ($r->cert_filter == 2) {
                $filter_cert = 'Диплом';
            }else{
                $filter_cert = (App::isLocale('ru'))? 'Нет' : 'Нi';
            }
        }else{
            $filter_cert = null;
        }

        $_lists = Master::getList($r, $cat_id);
        $lists = $_lists['course'];
        $show = $_lists['count'];

        $top_school = DB::table('masters_list')->select('organization_id')->groupBy('organization_id')->limit(10)->get();
        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }

        return view('master.index', compact('t', '_description', '_keywords', 'categorys_count', 'f_region', 'regions', 'max_price', 'show', 'lists', 'count', 'filter_city', 'filter_group', 'filter_cert', 'desc', 'schools_top', 'id', 'meta_title', 'cat_stage_1', 'cat_stage_2', 'cat_stage_3'));
    }
}
