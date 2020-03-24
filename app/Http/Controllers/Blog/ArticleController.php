<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article\Article;
use App\Article\Category;
use App\Article\Comment;
use App\Model\Category\Entity\Category as CourseCat;
use Course;

class ArticleController extends Controller
{
	public static $null = null;

    public function index(){
    	$articles = Article::orderBy('id', 'desc')->paginate(15);
    	$categorys = Category::get();
    	$tops = Article::orderBy('views', 'desc')->limit(10)->get();
    	$keywords = trans('layout/footer.Articles');
    	$description = trans('layout/footer.Articles') . ' от Get Skill';
    	return view('blog.index', compact('articles', 'categorys', 'tops', 'keywords', 'description'));
    }

    public function category($lang, Category $cat){
    	$articles = Article::where('cat_id', $cat->id)->orderBy('id', 'desc')->paginate(15);
    	$categorys = Category::get();
    	$tops = Article::orderBy('views', 'desc')->limit(10)->get();
    	$keywords = (app()->isLocale('ru'))? $cat->seo_name_ru :$cat->seo_name_ua;
    	$description = (app()->isLocale('ru'))? $cat->seo_desc_ru :$cat->seo_desc_ua;
    	return view('blog.index', compact('articles', 'categorys', 'tops', 'cat', 'keywords', 'description'));
    }

    public function article($lang, Category $cat, Article $post){
    	$keywords = (app()->isLocale('ru'))? $post->seo_name_ru : $post->seo_name_ua;
    	$description = (app()->isLocale('ru'))? $post->seo_desc_ru : $post->seo_desc_ua;
    	$post->views = $post->views + 1;
    	$post->save();
    	$cat_course = CourseCat::find($post->cat_course_id);
    	$courses = Course::where('category', 'LIKE', '% ' . $cat_course->id . ', %')->where('status', 1)->inRandomOrder()->limit(5)->get();
    	$comments = Comment::where('article_id', $post->id);

    	$id = $cat;
    	$route_artticle = $post;
    	return view('blog.article', compact('cat', 'post', 'keywords', 'description', 'cat_course', 'courses', 'comments', 'id', 'route_artticle'));
    }

    public function comment_add(Request $r){
    	Comment::addComment($r);
    	return redirect()->back();
    }

    public function comment_report($lang, Comment $comment){
    	$comment->complaint = 1;
    	$comment->save();
    	return redirect()->back();
    }
}
