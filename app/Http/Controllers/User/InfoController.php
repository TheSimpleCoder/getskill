<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Region\Entity\Region;
use App\UsersReport;
use App\FaqCategory;
use App\FaqArticle;
use DB;

class InfoController extends Controller
{
    public function about (){
        $regions = Region::get();
    	return view('info.about', compact('regions'));
    }

    public function services (){
    	return view('info.services');
    }

    public function faq (){
        $categorys = FaqCategory::get();
    	return view('info.faq', compact('categorys'));
    }

    public function faq_show($lang, FaqArticle $article){
        return view('info.faq-show', compact('article'));
    }

    public function contacts (){
    	return view('info.contacts');
    }

    public function report(Request $r){
        UsersReport::addNewReport($r);
        return redirect()->route('contacts', app()->getLocale())->with('success', (app()->isLocale('ru'))? 'Ваше письмо отправлено' : 'Ваш лист відправлений');
    }

    public function improvement (){
    	return view('info.improvement');
    }

    public function terms (){
        $term = DB::table('terms')->where('id', 1)->first();
    	return view('info.term', compact('term'));
    }

    public function offer (){
        $term = DB::table('terms')->where('id', 1)->first();
    	return view('info.offer', compact('term'));
    }

    public function rulles (){
        $term = DB::table('terms')->where('id', 1)->first();
        return view('info.terms', compact('term'));
    }
}
