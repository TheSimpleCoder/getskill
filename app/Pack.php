<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Payment;
use App;

class Pack extends Model
{

	public static function getNamePack($num){
		$return = __('cabinet/organization/payment.Tarif_' . $num);

		return $return;
	}

    public static function getPack(){
    	$user = Auth::user();

    	$res = Payment::where('user_id', $user->id)->where('status', 'success')->where('time', '>', time())->orderBy('id', 'desc')->first();

    	if(!$res){
    		$return = ['pack' => 1, 'time' => 'free', 'type' => Self::getNamePack(1)];
    		return $return;
    	}

    	$return = ['pack' => $res->pack, 'time' => $res->time, 'type' => Self::getNamePack($res->pack)];
    	return $return;
    }

    public static function getPackFormAccess($id){
    	$result = Payment::where('user_id', $id)->where('status', 'success')->where('time', '>', time())->where('pack', 3)->orderBy('id', 'desc')->first();

    	if(!$result){
    		return 'false';
    	}

    	return 'true';
    }

    public static function getRandUserTopCourse(){
        $result = Payment::select('user_id')->where('status', 'success');
        $result->where('time', '>', time());
        $result->where('pack', 3);
        $result->groupBy('user_id');
        $result->inRandomOrder();
        $result->limit(4);

        return $result->get();
    }

    public static function getUserAccessPack($user){
        $result = Payment::where('user_id', $user)->where('status', 'success')->where('time', '>', time())->orderBy('id', 'desc')->first();

        return $result;
    }
}
