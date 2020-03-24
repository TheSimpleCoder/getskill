<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Organization;
use App;

class Reviews extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['user_id', 'course_id', 'organization_id', 'user_avatar', 'user_name', 'text', 'star', 'time', 'parent_id', 'owner'];

    public static function addReview($r){
    	$user = Auth::user();
        $org = Organization::where('user_id', $user->id)->first();
        if($org){
            $result = Self::getParentId($r->parent_id);
            if($result){
                if($result->organization_id == null){
                    for ($i=0; $i < 1000000; $i++) { 
                        $result = Self::getParentId($result->parent_id);
                        if($result->organization_id != null){
                            break;
                        }
                    }

                    if($org->id == $result->organization_id){
                        $owner = 1;
                    }else{
                        $owner = 0;
                    }
                }
            }else{
                if($org->id == $r->organization){
                    $owner = 1;
                }else{
                    $owner = 0;
                }
            }
            
        }else{
            $owner = 0;
        }
    	Self::create([
    		'user_id' => $user->id,
    		'course_id' => $r->course,
    		'organization_id' => $r->organization,
    		'user_avatar' => '/' . $user->image,
    		'user_name' => $user->name,
    		'text' => $r->text,
    		'star' => $r->star,
    		'time' => time(),
    		'parent_id' => $r->parent_id,
            'owner' => $owner
    	]);

        Organization::where('id', $r->organization)->update(['rate' => Self::getRateSchool($r->organization)]);
    }

    public static function addReviewFeedback($r){
        $user = Auth::user();
        $org = Organization::where('user_id', $user->id)->first();
        if($org){
            $result = Self::getParentId($r->parent);
            if($result->organization_id == null){
                for ($i=0; $i < 1000000; $i++) { 
                    $result = Self::getParentId($result->parent_id);
                    if($result->organization_id != null){
                        break;
                    }
                }

                if($org->id == $result->organization_id){
                    $owner = 1;
                }else{
                    $owner = 0;
                }
            }else{
                if($org->id == $result->organization_id){
                    $owner = 1;
                }else{
                    $owner = 0;
                }
            }
            
        }else{
            $owner = 0;
        }
        Self::create([
            'user_id' => $user->id,
            'course_id' => $r->course,
            'user_avatar' => '/' . $user->image,
            'user_name' => $user->name,
            'text' => $r->text,
            'time' => time(),
            'parent_id' => $r->parent,
            'owner' => $owner
        ]);
    }

    public static function getRateForCourse($id){
        $rate = Self::where('course_id', $id)->where('type', 'course')->where('parent_id', null);

        $rate_count = 0;
        $res = 0;
        foreach ($rate->get() as $key) {
            $rate_count = $rate_count + $key->star;
        }

        if($rate->count() > 0){
            $res = $rate_count / $rate->count();
        }

        $return = $nombre_format_francais = number_format($res, 2, '.', '');

        return $return;
    }

    public static function getRateSchool($id){
        $rate = Self::where('organization_id', $id)->where('parent_id', null);

        $rate_count = 0;
        $res = 0;
        foreach ($rate->get() as $key) {
            $rate_count = $rate_count + $key->star;
        }

        if($rate->count() > 0){
            $res = $rate_count / $rate->count();
        }

        $return = $nombre_format_francais = number_format($res, 2, '.', '');

        return $return;
    }

    public static function getCountRateSchool($id){
        return $rate = Self::where('organization_id', $id)->where('parent_id', null)->count();
    }

    public static function getRateSchoolCountStar($star){
        if($star == 1){
            $rate = Organization::where('rate', '>=', 0);
            $rate = $rate->where('rate', '<=', $star + 0.99)->count();
        }else{
            $rate = Organization::where('rate', '>=', $star);
            $rate = $rate->where('rate', '<=', $star + 0.99)->count();
        }

        return $rate;
    }

    public static function getFeedbackAll($id){
        $result = Self::where('parent_id', $id)->get();

        return $result;
    }

    public static function getListOrganization($id){
        $result = Self::where('organization_id', $id)->where('parent_id', null)->get();

        return $result;
    }

    public static function getFeedbackForOrganization($id){
        $result = Self::where('parent_id', $id)->where('user_id', '<>', Auth::user()->id)->get();

        return $result;
    }

    public static function getFeedbackOrganization($id){
        $result = Self::where('parent_id', $id)->where('user_id', Auth::user()->id);

        return $result;
    }

    public static function fromReviewsOrganization($id){
        $self = Self::where('id', $id)->first();
        if($self->parent_id == null){
            $parent = $self;
        }else{
            $parent = Self::where('id', $self->parent_id)->first();
            if($parent->organization_id == null){
                for ($i=0; $i < 10000000; $i++) { 
                    $parent = Self::getParentId($parent->parent_id);

                    if($parent->parent_id == null){
                        break;
                    }
                }
            }
        }

        $org = Organization::where('id', $parent->organization_id)->first();

        (App::isLocale('ru'))? $return = $org->name_ru : $return = $org->name_ua;

        return $return;
    }

    public static function fromReviewsOrganizationID($id){
        $self = Self::where('id', $id)->first();
        if($self->parent_id == null){
            $parent = $self;
        }else{
            $parent = Self::where('id', $self->parent_id)->first();
            if($parent->organization_id == null){
                for ($i=0; $i < 10000000; $i++) { 
                    $parent = Self::getParentId($parent->parent_id);

                    if($parent->parent_id == null){
                        break;
                    }
                }
            }
        }

        $org = Organization::where('id', $parent->organization_id)->first();

        $return = $org->id;

        return $return;
    }

    public static function getListsChildUser($id){
        $arr = Self::where('parent_id', $id);

        return $arr;
    }

    public static function getParentId($id){
        $result = Self::where('id', $id)->first();

        return $result;
    }

    public static function getCountRateDB(){
        $self = Self::count();
        return $self;
    }
}
