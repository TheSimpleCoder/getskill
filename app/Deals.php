<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App;
use App\Organization;
use AnaliticD;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewDeal;
use App\Model\User\Entity\User;
use Course;

class Deals extends Model
{
    protected $table = 'deals';
    protected $fillable = ['user_id', 'organization_id', 'course_id', 'name_deal', 'name_user', 'phone_user', 'email_user', 'time', 'status', 'tag', 'date_course', 'budget'];

    public static function dealsAdd($r){
    	if(Auth::guest()){
    		$user = null;
    		$email = null;
    	}else{
    		$user = Auth::user()->id;
    		$email = Auth::user()->email;
    	}
        $org = Organization::where('id', $r->organization)->first();
        $admin = User::find($org->user_id);
    	Self::create([
    		'user_id' => $user,
    		'organization_id' => $r->organization,
    		'course_id' => $r->course,
    		'name_user' => $r->consultation_name,
    		'phone_user' => $r->consultation_phone,
    		'email_user' => $email,
    		'time' => time(),
    	]);

        $c = Course::find($r->course);

        AnaliticD::addAnalitic($org->user_id, $r->course, $r->type);

        $comment = ['phone' => $r->consultation_phone, 'name' => $r->consultation_name, 'course_name' => $c->name_ru, 'course_id' => $c->id];
        $toEmail = $admin->email;
        Mail::to($toEmail, 'Get Skill')->send(new NewDeal($comment));
    }

    public static function getNewDealsCount(){
    	$org = Organization::where('user_id', Auth::user()->id)->first();
        if(!$org){
            return 0;
        }
    	$count = Self::where('organization_id', $org->id)->where('status', 0)->where('arhiv', 0)->count();

    	return $count;
    }

    public static function dealStatus($status){
    	switch ($status) {
    		case 0:
    			$return = '<div class="deal__tag-status deal__tag-status--new-request">';
    			$return .= (App::isLocale('ru'))? 'Новая заявка' : 'Нова заявка';
    			break;
    		case 1:
    			$return = '<div class="deal__tag-status deal__tag-status--in-processing">';
    			$return .= (App::isLocale('ru'))? 'В обработке' : 'В обробцi';
    			break;
    		case 2:
    			$return = '<div class="deal__tag-status deal__tag-status--completed">';
    			$return .= (App::isLocale('ru'))? 'Завершен' : 'Завершено';
    			break;
    		case 3:
    			$return = '<div class="deal__tag-status deal__tag-status--canceled">';
    			$return .= (App::isLocale('ru'))? 'Отменен' : 'Скасовано';
    			break;
    	}

    	$return .= '</div>';

    	return $return;
    }

    public static function dealStatusName($num){
    	switch ($num) {
    		case 0:
    			$return = (App::isLocale('ru'))? 'Новая заявка' : 'Нова заявка';
    			break;
    		case 1:
    			$return = (App::isLocale('ru'))? 'В обработке' : 'В обробцi';
    			break;
    		case 2:
    			$return = (App::isLocale('ru'))? 'Завершен' : 'Завершено';
    			break;
    		case 3:
    			$return = (App::isLocale('ru'))? 'Отменен' : 'Скасовано';
    			break;
    	}

    	return $return;
    }

    public static function updateDeal($r){

    	$deal = Self::where('id', $r->id)->first();

    	$deal->course_id = $r->course_id;
    	$deal->name_deal = $r->deals_edit_name;
    	$deal->name_user = $r->deals_edit_list_name;
    	$deal->phone_user = $r->deals_edit_list_tel;
    	$deal->email_user = $r->deals_edit_list_email;
    	$deal->time = strtotime($r->date);
    	$deal->date_course = strtotime($r->date_course);
    	$deal->status = $r->status;
		
		if($r->status == 2 || $r->status == 3)
		{
			$deal->arhiv = 1;
		}
		
    	$deal->tag = $r->tag;
    	$deal->budget = $r->budget;
    	$deal->prepod = $r->prepod;

    	$deal->save();
    }

    public static function addNew($r){
    	$org = Organization::where('user_id', Auth::user()->id)->first();
    	Self::create([
    		'organization_id' => $org->id,
    		'course_id' => $r->course_id,
    		'name_deal' => $r->deals_edit_name,
    		'name_user' => $r->deals_edit_list_name,
    		'phone_user' => $r->deals_edit_list_tel,
    		'email_user' => $r->deals_edit_list_email,
    		'time' => strtotime($r->date),
    		'date_course' => strtotime($r->date_course),
    		'status' => $r->status,
    		'tag' => $r->tag,
    		'budget' => $r->budget,
    		'prepod' => $r->prepod
    	]);
    }
}
