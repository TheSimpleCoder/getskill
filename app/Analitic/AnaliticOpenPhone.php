<?php

namespace App\Analitic;

use Illuminate\Database\Eloquent\Model;
use Auth;

class AnaliticOpenPhone extends Model
{
    protected $table = 'analitic_open_phone';
    protected $fillable = ['user_id', 'time', 'open', 'course', 'type'];

    public static function addAnalitic($r){
    	Self::create([
    		'user_id' => $r->user,
    		'time' => time(),
    		'open' => 1,
    		'course' => $r->course,
    		'type' => $r->type
    	]);
    }

    public static function getCountOpen(){
        //Арефмитическии вспомагательные
        $x2_month = 2629743 * 2;
        $x2_day = 86400 * 2;
        $x2_week = 604800 * 2;

        $stat_max = time();
        $stat_min = time() - 2629743; //Месяц

        $stat_max_last = time() - 2629743;
        $stat_min_last = time() - $x2_month;
        if(isset($_GET['info'])){
            //Если есть
            switch ($_GET['info']) {
                case 'today':
                    $stat_min = strtotime(date('d.m.Y 00:00:00'));
                    $stat_max = time();

                    $stat_max_last = strtotime(date('d.m.Y 00:00:00'));
                    $stat_min_last = strtotime(date('d.m.Y 00:00:00')) - 86400;
                    break;
                case 'yesterday':
                    $stat_max = strtotime(date('d.m.Y 00:00:00'));
                    $stat_min = strtotime(date('d.m.Y 00:00:00')) - 86400;

                    $stat_max_last = strtotime(date('d.m.Y 00:00:00')) - 86400;
                    $stat_min_last = strtotime(date('d.m.Y 00:00:00')) - $x2_day;
                    break;
                case 'week':
                    $stat_max = time();
                    $stat_min = time() - 604800;

                    $stat_max_last = time() - 604800;
                    $stat_min_last = time() - $x2_week;
                    break;
            }
        }

        $result = Self::where('time', '<', $stat_max)->where('user_id', Auth::user()->id);
        $result = $result->where('time', '>', $stat_min);

        $result_last = Self::where('time', '<', $stat_max_last)->where('user_id', Auth::user()->id);
        $result_last = $result_last->where('time', '>', $stat_min_last);

        $a = $result->count();
        $b = $result_last->count();

        $res_1 = $a - $b;
        $res_2 = $a + $b;
        $res_3 = $res_2 / 2;
        if($res_3 == 0){
            $res_3 = 1;
        }
        $res_4 = $res_1 / $res_3;
        $res_5 = $res_4 * 100;

        if($res_5 < 0){
            $arrow = 'fall';
            $sign = '';
        }else{
            $arrow = '-top';
            $sign = '+';
        }

        $return = [
            'count' => $a,
            'procent' => (int)$res_5,
            'arrow' => $arrow,
            'sign' => $sign
        ];

        return $return;
    }

    public static function getStatItem($id, $type, $r){
        if(isset($r->info)){
            $x2_month = 2629743 * 2;
            $x2_day = 86400 * 2;
            $x2_week = 604800 * 2;

            //Если есть
            switch ($_GET['info']) {
                case 'today':
                    $stat_min = strtotime(date('d.m.Y 00:00:00'));
                    $stat_max = time();
                    break;
                case 'yesterday':
                    $stat_max = strtotime(date('d.m.Y 00:00:00'));
                    $stat_min = strtotime(date('d.m.Y 00:00:00')) - 86400;
                    break;
                case 'week':
                    $stat_max = time();
                    $stat_min = time() - 604800;
                    break;
            }

            $ret = Self::where('course', $id)->where('type', $type)->where('time', '>', $stat_min);
            $ret = $ret->where('time', '<', $stat_max)->count();
        }else{
            $time = time() - 2629743;
            $ret = Self::where('course', $id)->where('type', $type)->where('time', '>', $time)->count();
        }

        return $ret;
    }
}
