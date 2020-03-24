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

class HomeController extends Controller
{
    public function index(Request $r, $local, $cat_stage_1){
        $cat_sel = Category::where('slug', $cat_stage_1)->first();
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

        return view('master.index', compact('t', '_description', '_keywords', 'categorys_count', 'f_region', 'regions', 'max_price', 'show', 'lists', 'count', 'filter_city', 'filter_group', 'filter_cert', 'desc', 'schools_top', 'id', 'meta_title', 'cat_stage_1'));
    }

    public function master($lang, $id){
    	$course = Master::where('id', $id)->first();
        Master::where('id', $id)->update(['view' => $course->view + 1]);
        AnaliticV::addAnalitic($course->user_id, $id, 'course');
        $prepod_ex = explode(',', $course->teachers);
        $filias_ex = explode(',', $course->filia);
        $prepod = array();
        $filias = array();
        foreach ($prepod_ex as $value) {
            if($value == ''){
                continue;
            }
            $pre = Teachers::where('id', $value)->first();
            $prepod[] = $pre;
        }
        foreach ($filias_ex as $key) {
            if($key == ''){
                continue;
            }
            $fil = Filia::where('id', $key)->first();
            $city = Region::where('id', $fil->city)->first();
            $filias[] = [
                'filia' => $fil,
                'city' => (App::isLocale('ru'))? $city->name_ru : $city->name_uk,
            ];
        }
        $org = Organization::where('id', $course->organization_id)->first();
        $lists = Master::where('organization_id', $course->organization_id)->where('id', '<>', $id)->orderBy('id', 'desc')->limit(3)->get();
        $reviews = Reviews::where('course_id', $id)->where('type', 'master')->orderBy('id', 'desc');

        $files = File::where('course_id', $id)->where('type', 'master')->orderBy('sort', 'asc')->get();

        $title = (App::isLocale('ru'))? $course->name_ru : $course->name_ua;
        $description = mb_strimwidth((App::isLocale('ru'))? $course->desc_ru : $course->desc_ua, 0, 160, "...");
        $keywords = (App::isLocale('ru'))? $course->name_ru : $course->name_ua;

        return view('master.info', compact('course', 'prepod', 'filias', 'org', 'lists', 'reviews', 'files', 'id', 'title', 'description', 'keywords'));
    }

    public function morePosts(Request $r, $lang, $id){
        if($id == 'all'){
            $cat_id = 3;
        }else{
            $cat_id = $id;
        }
        Master::getList($r, $cat_id);
        $data = $_lists['course'];
        $show = $_lists['count'];

        // return response()->json($data);
        return View::make('master.template')->with(['data' => $data]);
    }
}
