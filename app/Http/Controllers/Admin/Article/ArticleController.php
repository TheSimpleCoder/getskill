<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article\Category;
use App\Article\Article;
use App\Model\Category\Entity\Category as CourseCat;

class ArticleController extends Controller
{
    public function index_category(){
    	$categorys = Category::paginate(15);
    	return view('admin.article.category-list', compact('categorys'));
    }

    public function add_category(){
    	return view('admin.article.category-add');
    }

    public function add_category_save(Request $r){
    	Category::addNewCategory($r);
    	return redirect()->route('admin.article.index_category');
    }

    public function edit_category(Category $category){
    	return view('admin.article.category-edit', compact('category'));
    }

    public function edit_category_save(Request $r){
    	Category::updateCategory($r);
    	return redirect()->route('admin.article.index_category');
    }

    public function delete_category(Category $category){
    	Category::where('id', $category->id)->delete();
    	return redirect()->route('admin.article.index_category');
    }

    public function index_article(){
    	$articles = Article::paginate(15);
    	return view('admin.article.article-list', compact('articles'));
    }

    public function add_article(){
    	$categorys = Category::get();
    	$cat_courses_online = CourseCat::where('parent_id', 1)->get();
    	$cat_courses_offline = CourseCat::where('parent_id', 2)->get();
    	return view('admin.article.article-add', compact('categorys', 'cat_courses_online', 'cat_courses_offline'));
    }

    public function add_article_save(Request $r){
    	Article::addNewCategory($r);
    	return redirect()->route('admin.article.index_article');
    }

    public function edit_article(Article $article){
    	$categorys = Category::get();
    	$cat_courses_online = CourseCat::where('parent_id', 1)->get();
    	$cat_courses_offline = CourseCat::where('parent_id', 2)->get();
    	return view('admin.article.article-edit', compact('article', 'categorys', 'cat_courses_online', 'cat_courses_offline'));
    }

    public function edit_article_save(Request $r){
    	Article::updateCategory($r);
    	return redirect()->route('admin.article.index_article');
    }
}
