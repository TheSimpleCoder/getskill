<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Deals;
use App\DealComments;
use App\Organization;
use App\Course;
use App\Teachers;
use Pack;
use App;
use Auth;

class DealsController extends Controller
{
    public function createDeals(Request $r){
		
		$recaptha = $r->get('g-recaptcha-response');
		$check_cap = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdCLeIUAAAAADUZhPTgLC7txUQ3yx9ZPNcANOhu&response=$recaptha");
		$check_cap = json_decode($check_cap);
		if(!$check_cap)
		{
			return back()->with('error', 'Капча не прошла проверку!');
		}
		
    	Deals::dealsAdd($r);

    	return redirect()->back()->with('success', (App::isLocale('ru'))? 'Заявка успешно отправлена' : 'Заявка успiшно вiдправлена');
    }

    public function index(){
    	if(Pack::getPack()['pack'] != 3){ return redirect(App::getLocale(). '/cabinet-organization/payment'); }

    	$org = Organization::where('user_id', Auth::user()->id)->first();
    	$lists = Deals::where('organization_id', $org->id)->where('arhiv', '<>', 1)->get();

    	return view('cabinet.organization.deals.index', compact('lists', 'org'));
    }

    public function arhiv(){
        if(Pack::getPack()['pack'] != 3){ return redirect(App::getLocale(). '/cabinet-organization/payment'); }

        $org = Organization::where('user_id', Auth::user()->id)->first();
        $lists = Deals::where('organization_id', $org->id)->where('arhiv', 1)->get();

        return view('cabinet.organization.deals.arhiv', compact('lists', 'org'));
    }

    public function delete(Request $r){
		
		$deals = Deals::where('id', $r->id)->first();
		
		if($r->type == "delFromArch")
		{
			$deals->delete();
		} else {
			$deals->arhiv = 1;
			$deals->save();
		}
		
    	return redirect()->back();
    }
	
	public function revoke($lang, $id)
	{
		$deals = Deals::where('id', $id)->first();
		$deals->arhiv = 0;
		$deals->save();
		return redirect()->back();
	}

    public function deleteGet(Request $r){
    	$deals = Deals::where('id', $r->id)->first();
        $deals->arhiv = 1;
        $deals->save();

    	return redirect(App::getLocale() . '/cabinet-organization/deals');
    }

    public function show($lang, $id){
    	if(Pack::getPack()['pack'] != 3){ return redirect(App::getLocale(). '/cabinet-organization/payment'); }

    	$deal = Deals::where('id', $id)->first();
    	$course = Course::where('id', $deal->course_id)->first();
    	$courseList = Course::where('user_id', Auth::user()->id)->where('status', 1)->get();

    	if($deal->prepod){
    		$_prepod = Teachers::where('id', $deal->prepod)->first();
    		$p_name = (App::isLocale('ru'))? $_prepod->name_ru : $_prepod->name_ua;
    		$p_id = $_prepod->id;
    	}else{
    		$p_name = '...';
    		$p_id = 0;
    	}
    	$prepodList = Teachers::where('user_id', Auth::user()->id)->get();
    	$comments = DealComments::where('deal_id', $id)->get();

    	return view('cabinet.organization.deals.show', compact('deal', 'course', 'courseList', 'p_name', 'prepodList', 'p_id', 'comments'));
    }

    public function arhivShow($lang, $id){
        if(Pack::getPack()['pack'] != 3){ return redirect(App::getLocale(). '/cabinet-organization/payment'); }

        $deal = Deals::where('id', $id)->first();
        $course = Course::where('id', $deal->course_id)->first();
        $courseList = Course::where('user_id', Auth::user()->id)->where('status', 1)->get();

        if($deal->prepod){
            $_prepod = Teachers::where('id', $deal->prepod)->first();
            $p_name = (App::isLocale('ru'))? $_prepod->name_ru : $_prepod->name_ua;
            $p_id = $_prepod->id;
        }else{
            $p_name = '...';
            $p_id = 0;
        }
        $prepodList = Teachers::where('user_id', Auth::user()->id)->get();
        $comments = DealComments::where('deal_id', $id)->get();

        return view('cabinet.organization.deals.arhiv-show', compact('deal', 'course', 'courseList', 'p_name', 'prepodList', 'p_id', 'comments'));
    }

    public function add(){
    	if(Pack::getPack()['pack'] != 3){ return redirect(App::getLocale(). '/cabinet-organization/payment'); }

		$courseList = Course::where('user_id', Auth::user()->id)->where('status', 1)->get();
		$prepodList = Teachers::where('user_id', Auth::user()->id)->get();

		return view('cabinet.organization.deals.add', compact('courseList', 'prepodList'));
    }

    public function addNew(Request $r){
    	Deals::addNew($r);

    	return redirect(App::getLocale() . '/cabinet-organization/deals');
    }

    public function update(Request $r){
    	Deals::updateDeal($r);

    	return redirect()->back();
    }

    public function addComment(Request $r){
    	DealComments::addComment($r);

    	return redirect()->back();
    }

    public function deleteComment(Request $r){
    	DealComments::where('id', $r->id)->delete();

    	return redirect()->back();
    }

    public function updateComment(Request $r){
    	DealComments::updateComment($r);

    	return redirect()->back();
    }
}
