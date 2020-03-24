<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use App\Filia;
use App\Model\Region\Entity\Region;
use App;
use App\Reviews;
use App\Course;
use App\Master;
use App\Model\Category\Entity\Category as Cat;
use App\Model\Publisher\Category\Entity\Category;
use App\File;
use View;

class HomeController extends Controller
{
    public function description($lang, $id){
    	$org = Organization::where('id', $id)->first();
    	$filias_ex = Filia::where('organization_id', $org->id)->where('active', 'on')->get();
    	$filias = array();
    	foreach ($filias_ex as $key) {
            if(!$key){
                continue;
            }
            $city = Region::where('id', $key->city)->first();
            $filias[] = [
                'filia' => $key,
                'city' => (App::isLocale('ru'))? $city->name_ru : $city->name_uk,
            ];
        }
        $reviews = Reviews::where('organization_id', $id)->orderBy('id', 'desc');

        $files = File::where('organization_id', $id)->where('type', 'organization')->orderBy('sort', 'asc')->get();

        $title = $org->name_ru;
        //$title = (App::isLocale('ru'))? $course->name_ru : $course->name_ua;
        //$description = mb_strimwidth((App::isLocale('ru'))? $course->desc_ru : $course->desc_ua, 0, 160, "...");
        $description = (App::isLocale('ru'))? $org->desc_ru : $org->desc_ua;
        $keywords = '';
        //$keywords = (App::isLocale('ru'))? $course->name_ru : $course->name_ua;

    	return view('school.index', compact('org', 'filias', 'reviews', 'files', 'id', 'title', 'description', 'keywords'));
    }

    public function courses ($lang, $id){
    	$lists = Course::where('organization_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
    	$org = Organization::where('id', $id)->first();
    	$filias_ex = Filia::where('organization_id', $org->id)->where('active', 'on')->get();
    	$filias = array();
    	foreach ($filias_ex as $key) {
            if(!$key){
                continue;
            }
            $city = Region::where('id', $key->city)->first();
            $filias[] = [
                'filia' => $key,
                'city' => (App::isLocale('ru'))? $city->name_ru : $city->name_uk,
            ];
        }
        $reviews = Reviews::where('organization_id', $id)->orderBy('id', 'desc');

    	return view('school.course', compact('lists', 'org', 'filias', 'reviews', 'id'));
    }

    public function master ($lang, $id){
        $lists = Master::where('organization_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
        $org = Organization::where('id', $id)->first();
        $filias_ex = Filia::where('organization_id', $org->id)->where('active', 'on')->get();
        $filias = array();
        foreach ($filias_ex as $key) {
            if(!$key){
                continue;
            }
            $city = Region::where('id', $key->city)->first();
            $filias[] = [
                'filia' => $key,
                'city' => (App::isLocale('ru'))? $city->name_ru : $city->name_uk,
            ];
        }
        $reviews = Reviews::where('organization_id', $id)->orderBy('id', 'desc');

        return view('school.master', compact('lists', 'org', 'filias', 'reviews', 'id'));
    }

    public function reviews($lang, $id){
    	$org = Organization::where('id', $id)->first();
    	$filias_ex = Filia::where('organization_id', $org->id)->where('active', 'on')->get();
    	$filias = array();
    	foreach ($filias_ex as $key) {
            if(!$key){
                continue;
            }
            $city = Region::where('id', $key->city)->first();
            $filias[] = [
                'filia' => $key,
                'city' => (App::isLocale('ru'))? $city->name_ru : $city->name_uk,
            ];
        }
        $reviews = Reviews::where('organization_id', $id)->orderBy('id', 'desc');

        return view('school.reviews', compact('org', 'filias', 'reviews', 'id'));
    }

    public function schools(Request $r, $local, $cat_stage_1){
        $cat_sel = Category::where('slug', $cat_stage_1)->first();
        if($cat_stage_1 == 'all'){
            $id = 'all';
        }else{
            $id = $cat_sel->id;
        }

        $lists = Organization::orderBy('id', 'desc')->get();
        $count = Organization::count();
        $cats = array();
        $c_id = array();
        $show = 0;
        $regions = Region::get();
        $category = new Category;

        $cat_id = $id;
        if($id == 'all'){
            $cats = Category::where('parent_id', null)->get();
            
            $t = '';
            $_description = '';
            $_keywords = '';
            $desc = '';
            $meta_title = (App::islocale('ru'))? 'Школы' : 'Школи';
        }else{
            $_cats = Category::where('parent_id', $id)->get();
            foreach ($_cats as $key) {
                $s = $category->getChildCat($key->id, 2);
                $cats[] = [
                    'cat' => $key,
                    'count' => $s['count']
                ];
                array_push($c_id, $s['course']);
            }
            if($_cats->count() < 1){
                $s = $category->getChildCat($id, 2);
            }
            $_t = Category::where('id', $id)->first();
            $t = (App::isLocale('ru'))? $_t->name_ru : $_t->name_uk;
            $_description = (App::isLocale('ru'))? $_t->meta_description_ru : $_t->meta_description_uk;
            $_keywords = (App::isLocale('ru'))? $_t->meta_keywords_ru : $_t->meta_keywords_uk;
            $desc = (App::isLocale('ru'))? $_t->description_ru : $_t->description_uk;
            $meta_title = (App::isLocale('ru'))? $_t->meta_title_ru : $_t->meta_title_uk;
        }

        $categorys = Category::where('parent_id', $cat_id)->get();
        if($cat_id == 'all'){
            $categorys = Category::where('parent_id', null)->get();
        }
        
        if(!$categorys){
            $categorys = Category::where('id', $cat_id)->get();
            
        }

        $categorys_count = Organization::getCountOrgCat($categorys);

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

        $_lists = Organization::getList($r, $cat_id);
        $lists = $_lists['course'];
        $show = $_lists['count'];

        if($r->city_filter){
            $f_city = Region::where('id', $r->city_filter)->first();
            $filter_city = (App::isLocale('ru'))? $f_city->name_ru : $f_city->name_uk;
        }else{
            $filter_city = null;
        }

        return view('school.list', compact('t', '_description', '_keywords', 'categorys_count', 'f_region', 'regions', 'max_price', 'show', 'lists', 'count', 'filter_city', 'filter_group', 'filter_cert', 'desc', 'schools_top', 'id', 'meta_title', 'cat_stage_1'));
    }

    public function morePosts(Request $r, $lang, $id){
        $_lists = Organization::getList($r, $id);
        $data = $_lists['course'];
        $show = $_lists['count'];

        // return response()->json($data);
        return View::make('school.template')->with(['data' => $data]);
    }
}
