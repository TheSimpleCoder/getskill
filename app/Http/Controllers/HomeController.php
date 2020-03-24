<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Organization;
use App\Master;
use App\Article\Article;
use App\Model\Region\Entity\Region;
use App\Model\Category\Entity\Category;
use Pack;
use DB;
use Session;

use App\File;

class HomeController extends AppController
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(Request $request)
    {
    	$page_number = '';
    	$countOrg = Organization::getCountOrganization();

    	$masters = Master::where('date', '>', time())->where('status', 1)->orderBy('date', 'desc')->limit(6)->get();

    	$organizations = array();
    	$topCourse = Course::select(\DB::raw('MAX(view)'), 'organization_id');
    	$topCourse = $topCourse->where('status', 1);
    	$topCourse = $topCourse->groupBy('organization_id')->limit(16);
    	foreach ($topCourse->get() as $tc) {
    		$org = Organization::where('id', $tc->organization_id)->first();
    		$organizations[] = $org;
    	}

        $articles = Article::orderBy('id', 'desc')->limit(3)->get();

        return view('home', compact('page_number', 'countOrg', 'masters', 'organizations', 'articles'));
    }

    public function articles(){
        $page_number = '';
        $articles = Article::orderBy('id', 'desc')->paginate(15);
        return view('articles', compact('page_number', 'articles'));
    }

    public function courses_all(){
        $regions = Region::get();
        $title = (app()->isLocale('ru'))? 'Курсы Украины' : 'Курси України';
        $slug = 'ukraina';
        $r = (object) ['city_filter' => null, 'order_filter' => null, 'filter_min_price' => 0];
        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), 2);
        $lists = Course::getListNoneFilter($slug, 2);

        $category_offline = Category::where('parent_id', 2)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region', compact('regions', 'title', 'category_offline', 'r', 'slug', 'topCourse', 'lists', 'schools_top'));
    }

    public function courses_all_region($lang, $slug){
        $regions = Region::get();
        $title = (app()->isLocale('ru'))? 'Курсы Украины' : 'Курси України';
        $selected_region = Region::where('slug', $slug)->first();

        $lists = Course::getListNoneFilter($selected_region->id, 2);
        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), 2);

        $category_offline = Category::where('parent_id', 2)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region', compact('regions', 'title', 'category_offline', 'r', 'selected_region', 'slug', 'lists', 'topCourse', 'schools_top'));
    }

    //Курсы вложеной категории первого уровня
    public function courses_all_region_stage_one($lang, $slug, $cat_stage_1){
        $regions = Region::get();
        $selected_region = Region::where('slug', $slug)->first();
        $selected_category = Category::where('slug', $cat_stage_1)->first();
        $title = (app()->isLocale('ru'))? $selected_category->name_ru : $selected_category->name_uk;

        $lists = Course::getListNoneFilter($selected_region->id, $selected_category->id);
        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), 2);

        $category_offline = Category::where('parent_id', $selected_category->id)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region', compact('regions', 'title', 'category_offline', 'r', 'selected_region', 'slug', 'cat_stage_1', 'lists', 'topCourse', 'schools_top'));
    }

    //Курсы вложеной категории второго уровня
    public function courses_all_region_stage_two($lang, $slug, $cat_stage_1, $cat_stage_2){
        $regions = Region::get();
        $selected_region = Region::where('slug', $slug)->first();
        $selected_category = Category::where('slug', $cat_stage_2)->first();
        $title = (app()->isLocale('ru'))? $selected_category->name_ru : $selected_category->name_uk;

        $lists = Course::getListNoneFilter($selected_region->id, $selected_category->id);
        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), 2);

        $category_offline = Category::where('parent_id', $selected_category->id)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region', compact('regions', 'title', 'category_offline', 'r', 'selected_region', 'slug', 'cat_stage_1', 'cat_stage_2', 'topCourse', 'lists', 'schools_top'));
    }

    //Курсы вложеной категории третьего уровня
    public function courses_all_region_stage_tree($lang, $slug, $cat_stage_1, $cat_stage_2, $cat_stage_3){
        $regions = Region::get();
        $selected_region = Region::where('slug', $slug)->first();
        $selected_category = Category::where('slug', $cat_stage_3)->first();
        $title = (app()->isLocale('ru'))? $selected_category->name_ru : $selected_category->name_uk;

        $lists = Course::getListNoneFilter($selected_region->id, $selected_category->id);
        $topCourse = Course::getTopCourse(Pack::getRandUserTopCourse(), 2);

        $category_offline = Category::where('parent_id', $selected_category->id)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region', compact('regions', 'title', 'category_offline', 'r', 'selected_region', 'slug', 'cat_stage_1', 'cat_stage_2', 'cat_stage_3', 'topCourse', 'lists', 'schools_top'));
    }

    //-------------
    //Мастер-классы категория + город
    //-------------

    //Индексная страница
    public function masters_all(){
        $regions = Region::get();
        $title = (app()->isLocale('ru'))? 'Мастер-классы Украины' : 'Мастер-классы України';
        $slug = 'ukraina';

        $lists = Master::getListNoneFilter($slug, 3);

        $category_master = Category::where('parent_id', 3)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region-masters', compact('regions', 'title', 'category_master', 'r', 'slug', 'lists', 'schools_top'));
    }

    //Страница с выбраным регионом
    public function masters_all_region($lang, $slug){
        $regions = Region::get();
        $title = (app()->isLocale('ru'))? 'Мастер-классы Украины' : 'Мастер-классы України';
        $selected_region = Region::where('slug', $slug)->first();

        $lists = Master::getListNoneFilter($selected_region->id, 3);

        $category_master = Category::where('parent_id', 3)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region-masters', compact('regions', 'title', 'category_master', 'r', 'selected_region', 'slug', 'lists', 'schools_top'));
    }

    //Мастер-классы вложеной категории первого уровня
    public function masters_all_region_stage_one($lang, $slug, $cat_stage_1){
        $regions = Region::get();
        $selected_region = Region::where('slug', $slug)->first();
        $selected_category = Category::where('slug', $cat_stage_1)->first();
        $title = (app()->isLocale('ru'))? $selected_category->name_ru : $selected_category->name_uk;

        $lists = Master::getListNoneFilter($selected_region->id, $selected_category->id);

        $category_master = Category::where('parent_id', $selected_category->id)->get();;

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region-masters', compact('regions', 'title', 'category_master', 'r', 'selected_region', 'slug', 'cat_stage_1', 'lists', 'schools_top'));
    }

    //Мастер-классы вложеной категории второго уровня
    public function masters_all_region_stage_two($lang, $slug, $cat_stage_1, $cat_stage_2){
        $regions = Region::get();
        $selected_region = Region::where('slug', $slug)->first();
        $selected_category = Category::where('slug', $cat_stage_2)->first();
        $title = (app()->isLocale('ru'))? $selected_category->name_ru : $selected_category->name_uk;

        $lists = Master::getListNoneFilter($selected_region->id, $selected_category->id);

        $category_master = Category::where('parent_id', $selected_category->id)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region-masters', compact('regions', 'title', 'category_master', 'r', 'selected_region', 'slug', 'cat_stage_1', 'cat_stage_2', 'lists', 'schools_top'));
    }

    //Курсы вложеной категории третьего уровня
    public function masters_all_region_stage_tree($lang, $slug, $cat_stage_1, $cat_stage_2, $cat_stage_3){
        $regions = Region::get();
        $selected_region = Region::where('slug', $slug)->first();
        $selected_category = Category::where('slug', $cat_stage_3)->first();
        $title = (app()->isLocale('ru'))? $selected_category->name_ru : $selected_category->name_uk;

        $lists = Master::getListNoneFilter($selected_region->id, $selected_category->id);

        $category_master = Category::where('parent_id', $selected_category->id)->get();

        $top_school = DB::table('course_list')->select('organization_id')->groupBy('organization_id')->orderBy('view', 'desc')->limit(10)->get();

        $schools_top = array();
        foreach ($top_school as $key) {
            $sc = Organization::where('id', $key->organization_id)->first();
            if(!$sc){
                continue;
            }
            $schools_top[] = $sc;
        }
        return view('region-masters', compact('regions', 'title', 'category_master', 'r', 'selected_region', 'slug', 'cat_stage_1', 'cat_stage_2', 'cat_stage_3', 'lists', 'schools_top'));
    }

    public function sitemap() {
        $courses = Course::where('status', 1)->get();
        $masters = Master::where('status', 1)->get();
        return response()->view('sitemap', ['courses' => $courses])->header('Content-Type', 'text/xml');
    }

    public function newSortFile(Request $r){
        $sorts = explode(',', $r->sort_gallery);

        $i = 1;
        foreach ($sorts as $key) {
            $file = File::where('id', $key)->first();
            $file->sort = $i;
            $file->save();
            $i++;
        }
    }

    public function setlocale(Request $r, $locale){
        $link = explode(app()->getLocale(), $r->url);
        
        if (in_array($locale, \Config::get('app.locales'))) {   # Проверяем, что у пользователя выбран доступный язык 
            Session::put('locale', $locale);                    # И устанавливаем его в сессии под именем locale
        }
        return redirect($locale . $link[1]);
    }
}
