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

class PageController extends Controller
{
    public function schools_stage_2(Request $r, $local, $cat_stage_1, $cat_stage_2){
        $cat_sel = Category::where('slug', $cat_stage_2)->first();
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

        return view('school.list', compact('t', '_description', '_keywords', 'categorys_count', 'f_region', 'regions', 'max_price', 'show', 'lists', 'count', 'filter_city', 'filter_group', 'filter_cert', 'desc', 'schools_top', 'id', 'meta_title', 'cat_stage_1', 'cat_stage_2'));
    }

    public function schools_stage_3(Request $r, $local, $cat_stage_1, $cat_stage_2, $cat_stage_3){
        $cat_sel = Category::where('slug', $cat_stage_3)->first();
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

        return view('school.list', compact('t', '_description', '_keywords', 'categorys_count', 'f_region', 'regions', 'max_price', 'show', 'lists', 'count', 'filter_city', 'filter_group', 'filter_cert', 'desc', 'schools_top', 'id', 'meta_title', 'cat_stage_1', 'cat_stage_2', 'cat_stage_3'));
    }
}
