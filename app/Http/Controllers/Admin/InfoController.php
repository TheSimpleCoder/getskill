<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsersReport;
use App\FaqCategory;
use App\FaqArticle;
use DB;

class InfoController extends Controller
{
    public function feedback(){
    	$lists = UsersReport::orderBy('id', 'desc')->paginate(25);
    	return view('admin.info.feedback', compact('lists'));
    }

    public function faq_category(){
    	$lists = FaqCategory::orderBy('id', 'asc')->paginate(25);
    	return view('admin.info.faq-category-list', compact('lists'));
    }

    public function faq_category_add(){
    	return view('admin.info.faq-category-add');
    }

    public function faq_category_add_save(Request $r){
        FaqCategory::addNewCategory($r);
        return redirect()->route('admin.faq_category');
    }

    public function faq_category_edit(FaqCategory $category){
        return view('admin.info.faq-category-edit', compact('category'));
    }

    public function faq_category_add_update(Request $r){
        FaqCategory::updateCategory($r);
        return redirect()->route('admin.faq_category');
    }

    public function faq_article(){
        $lists = FaqArticle::orderBy('id', 'asc')->paginate(25);
        return view('admin.info.faq-article-list', compact('lists'));
    }

    public function faq_article_add(){
        $categorys = FaqCategory::get();
        return view('admin.info.faq-article-add', compact('categorys'));
    }

    public function faq_article_add_save(Request $r){
        FaqArticle::addNewArticle($r);
        return redirect()->route('admin.faq_article');
    }

    public function faq_article_edit(FaqArticle $article){
        $categorys = FaqCategory::get();
        return view('admin.info.faq-article-edit', compact('article', 'categorys'));
    }

    public function faq_article_add_update(Request $r){
        FaqArticle::updateArticle($r);
        return redirect()->route('admin.faq_article');
    }

    public function terms(){
        $terms = DB::table('terms')->where('id', 1)->first();
        return view('admin.info.terms', compact('terms'));
    }

    public function terms_update(Request $r){
        $terms = DB::table('terms')->where('id', 1)->update([
            'rules_ru' => $r->rules_ru,
            'rules_ua' => $r->rules_ua,
            'offer_ru' => $r->offer_ru,
            'offer_ua' => $r->offer_ua,
            'terms_ru' => $r->terms_ru,
            'terms_ua' => $r->terms_ua,
        ]);
        return redirect()->back();
    }
}
