<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
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
use Pack;
use AnaliticV;
use View;

class PageController extends Controller
{
    public function index_off_stage_2(Request $r, $local, $cat_stage_1, $cat_stage_2){
        $cat_sel = Category::where('slug', $cat_stage_2)->first();
        if($cat_stage_1 == 'all'){
            $id = 'all';
        }else{
            $id = $cat_sel->id;
        }
    	$category = new Category;
    	$count = Course::where('category', 'LIKE', '%2, %')->where('status', 1)->count();
    	$cats = array();
    	$c_id = array();
    	$show = 0;
    	$regions = Region::get();
    	$page_number = $id;
    	$max_price = Course::where('category', 'LIKE', '%2, %')->orderBy('price_about', 'desc')->where('status', 1)->first();
    	$_filter_region = (isset($_GET['city_filter']))? $_GET['city_filter'] : '';
    	if($_filter_region != ''){
    		$filter_region = Region::where('id', $_filter_region)->first();
    		$f_region = (App::isLocale('ru'))? $filter_region->name_ru : $filter_region->name_uk;
    	}else{
    		$f_region = __(('course/home.Select'));
    	}

    	if($id == 'all'){
    		$t = '';
    		$_description = '';
			$_keywords = '';
            $meta_title = (App::isLocale('ru'))? 'Курсы Украина' : 'Курси Україна';
			$desc = '';
            $cat_id = 2;
    	}else{
    		$_t = Category::where('id', $id)->first();
    		$t = (App::isLocale('ru'))? $_t->name_ru : $_t->name_uk;
    		$_description = (App::isLocale('ru'))? $_t->meta_description_ru : $_t->meta_description_uk;
			$_keywords = (App::isLocale('ru'))? $_t->meta_keywords_ru : $_t->meta_keywords_uk;
			$desc = (App::isLocale('ru'))? $_t->description_ru : $_t->description_uk;
            $meta_title = (App::isLocale('ru'))? $_t->meta_title_ru : $_t->meta_title_uk;
            $cat_id = $id;
    	}

        $categorys = Category::where('parent_id', $cat_id)->get();
        if(!$categorys){
            $categorys = Category::where('id', $cat_id)->get();
            
        }
        $cats = Course::getCountCourseCat($categorys);

    	$course = new Course;
    	$_lists = $course->getList($r, $cat_id);
    	$lists = $_lists['course'];
    	$show = $_lists['count'];

    	if($r->city_filter){
    		$f_city = Region::where('id', $r->city_filter)->first();
    		$filter_city = (App::isLocale('ru'))? $f_city->name_ru : $f_city->name_uk;
    	}else{
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

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }

        if($id == 'all'){
            $topCourseCat = 2;
        }else{
            $topCourseCat = $id;
        }

        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), $topCourseCat);

    	return view('course.home', compact('cats', 'count', 't', 'show', 'regions', 'filter_city', 'filter_group', 'filter_cert', 'lists', 'page_number', '_description', '_keywords', 'desc', 'max_price', 'f_region', '_lists', 'schools_top', 'topCourse', 'id', 'meta_title', 'cat_stage_1', 'cat_stage_2'));
    }

    public function index_off_stage_3(Request $r, $local, $cat_stage_1, $cat_stage_2, $cat_stage_3){
        $cat_sel = Category::where('slug', $cat_stage_3)->first();
        if($cat_stage_1 == 'all'){
            $id = 'all';
        }else{
            $id = $cat_sel->id;
        }
    	$category = new Category;
    	$count = Course::where('category', 'LIKE', '%2, %')->where('status', 1)->count();
    	$cats = array();
    	$c_id = array();
    	$show = 0;
    	$regions = Region::get();
    	$page_number = $id;
    	$max_price = Course::where('category', 'LIKE', '%2, %')->orderBy('price_about', 'desc')->where('status', 1)->first();
    	$_filter_region = (isset($_GET['city_filter']))? $_GET['city_filter'] : '';
    	if($_filter_region != ''){
    		$filter_region = Region::where('id', $_filter_region)->first();
    		$f_region = (App::isLocale('ru'))? $filter_region->name_ru : $filter_region->name_uk;
    	}else{
    		$f_region = __(('course/home.Select'));
    	}

    	if($id == 'all'){
    		$t = '';
    		$_description = '';
			$_keywords = '';
            $meta_title = (App::isLocale('ru'))? 'Курсы Украина' : 'Курси Україна';
			$desc = '';
            $cat_id = 2;
    	}else{
    		$_t = Category::where('id', $id)->first();
    		$t = (App::isLocale('ru'))? $_t->name_ru : $_t->name_uk;
    		$_description = (App::isLocale('ru'))? $_t->meta_description_ru : $_t->meta_description_uk;
			$_keywords = (App::isLocale('ru'))? $_t->meta_keywords_ru : $_t->meta_keywords_uk;
			$desc = (App::isLocale('ru'))? $_t->description_ru : $_t->description_uk;
            $meta_title = (App::isLocale('ru'))? $_t->meta_title_ru : $_t->meta_title_uk;
            $cat_id = $id;
    	}

        $categorys = Category::where('parent_id', $cat_id)->get();
        if(!$categorys){
            $categorys = Category::where('id', $cat_id)->get();
            
        }
        $cats = Course::getCountCourseCat($categorys);

    	$course = new Course;
    	$_lists = $course->getList($r, $cat_id);
    	$lists = $_lists['course'];
    	$show = $_lists['count'];

    	if($r->city_filter){
    		$f_city = Region::where('id', $r->city_filter)->first();
    		$filter_city = (App::isLocale('ru'))? $f_city->name_ru : $f_city->name_uk;
    	}else{
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

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }

        if($id == 'all'){
            $topCourseCat = 2;
        }else{
            $topCourseCat = $id;
        }

        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), $topCourseCat);

    	return view('course.home', compact('cats', 'count', 't', 'show', 'regions', 'filter_city', 'filter_group', 'filter_cert', 'lists', 'page_number', '_description', '_keywords', 'desc', 'max_price', 'f_region', '_lists', 'schools_top', 'topCourse', 'id', 'meta_title', 'cat_stage_1', 'cat_stage_2', 'cat_stage_3'));
    }

    public function index_on_stage_2(Request $r, $local, $cat_stage_1, $cat_stage_2){
        $cat_sel = Category::where('slug', $cat_stage_2)->first();
        if($cat_stage_1 == 'all'){
            $id = 'all';
        }else{
            $id = $cat_sel->id;
        }
        $current_cat =  Category::where('id', $id)->first();
        $regions = Region::get();
        $max_price = Course::where('category', 'LIKE', '% 1, %')->orderBy('price_about', 'desc')->where('status', 1)->first();
        $count = Course::where('category', 'LIKE', '% 1, %')->where('status', 1)->count();

        $show = 0;
        $desc = '';

        if($id == 'all'){
            $_description = 'Курсы';
            $_keywords = 'Курси';
            $t = '';
            $cat_id = 1;
            $meta_title = (App::isLocale('ru'))? 'Курсы Украина' : 'Курси Україна';
        }else{
            $_t = Category::where('id', $id)->first();
            $_description = (App::isLocale('ru'))? $current_cat->meta_description_ru : $current_cat->meta_description_uk;
            $_keywords = (App::isLocale('ru'))? $current_cat->meta_keywords_ru : $current_cat->meta_keyword_uk;
            $t = (App::isLocale('ru'))? $current_cat->name_ru : $current_cat->name_uk;
            $cat_id = $id;
            $desc = (App::isLocale('ru'))? $current_cat->description_ru : $current_cat->description_uk;
            $meta_title = (App::isLocale('ru'))? $_t->meta_title_ru : $_t->meta_title_uk;
        }

        $categorys = Category::where('parent_id', $cat_id)->get();
        if(!$categorys){
            $categorys = Category::where('id', $cat_id)->get();
            
        }
        $categorys_count = Course::getCountCourseCat($categorys);

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

        $_lists = Course::getList($r, $cat_id);
        $lists = $_lists['course'];
        $show = $_lists['count'];

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->limit(10)->get();
        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }

        if($id == 'all'){
            $topCourseCat = 1;
        }else{
            $topCourseCat = $id;
        }

        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), $topCourseCat);

        return view('course.online', compact('t', '_description', '_keywords', 'categorys_count', 'f_region', 'regions', 'max_price', 'show', 'lists', 'count', 'filter_city', 'filter_group', 'filter_cert', 'desc', 'schools_top', 'topCourse', 'id', 'meta_title', 'cat_stage_1', 'cat_stage_2'));
    }

    public function index_on_stage_3(Request $r, $local, $cat_stage_1, $cat_stage_2, $cat_stage_3){
        $cat_sel = Category::where('slug', $cat_stage_3)->first();
        if($cat_stage_1 == 'all'){
            $id = 'all';
        }else{
            $id = $cat_sel->id;
        }
        $current_cat =  Category::where('id', $id)->first();
        $regions = Region::get();
        $max_price = Course::where('category', 'LIKE', '% 1, %')->orderBy('price_about', 'desc')->where('status', 1)->first();
        $count = Course::where('category', 'LIKE', '% 1, %')->where('status', 1)->count();

        $show = 0;
        $desc = '';

        if($id == 'all'){
            $_description = 'Курсы';
            $_keywords = 'Курси';
            $t = '';
            $cat_id = 1;
            $meta_title = (App::isLocale('ru'))? 'Курсы Украина' : 'Курси Україна';
        }else{
            $_t = Category::where('id', $id)->first();
            $_description = (App::isLocale('ru'))? $current_cat->meta_description_ru : $current_cat->meta_description_uk;
            $_keywords = (App::isLocale('ru'))? $current_cat->meta_keywords_ru : $current_cat->meta_keyword_uk;
            $t = (App::isLocale('ru'))? $current_cat->name_ru : $current_cat->name_uk;
            $cat_id = $id;
            $desc = (App::isLocale('ru'))? $current_cat->description_ru : $current_cat->description_uk;
            $meta_title = (App::isLocale('ru'))? $_t->meta_title_ru : $_t->meta_title_uk;
        }

        $categorys = Category::where('parent_id', $cat_id)->get();
        if(!$categorys){
            $categorys = Category::where('id', $cat_id)->get();
            
        }
        $categorys_count = Course::getCountCourseCat($categorys);

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

        $_lists = Course::getList($r, $cat_id);
        $lists = $_lists['course'];
        $show = $_lists['count'];

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->limit(10)->get();
        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }

        if($id == 'all'){
            $topCourseCat = 1;
        }else{
            $topCourseCat = $id;
        }

        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), $topCourseCat);

        return view('course.online', compact('t', '_description', '_keywords', 'categorys_count', 'f_region', 'regions', 'max_price', 'show', 'lists', 'count', 'filter_city', 'filter_group', 'filter_cert', 'desc', 'schools_top', 'topCourse', 'id', 'meta_title', 'cat_stage_1', 'cat_stage_2', 'cat_stage_3'));
    }
}
