<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use Rate;
use App\Admin\CronTask;

class ParserController extends Controller
{
    public function index(){
    	$organizations = Organization::get();
        return view('admin.parser.index', compact('organizations'));
    }

    public function start_parsing(Request $r){
		print_r($r->organization); exit;
    	$xml = simplexml_load_file('https://maps.googleapis.com/maps/api/place/textsearch/xml?query='. $r->name .'&sensor=true&key=AIzaSyAkQZ-kDwtkbeeLtHCNaizwSccifP4vWDU');
	
		$characters = 'https://maps.googleapis.com/maps/api/place/details/json?placeid='. $xml->result->place_id .'&key=AIzaSyAkQZ-kDwtkbeeLtHCNaizwSccifP4vWDU';
		$characters = file_get_contents($characters);
		$characters = json_decode($characters, true);

		foreach ($characters['result']['reviews'] as $value) {
			$info = Rate::where('time', $value['time'])->first();
			
			if(!$info){
				Rate::create([
					'user_id' => 0,
					'course_id' => 0,
					'organization_id' => $r->organization,
					'user_avatar' => $value['profile_photo_url'],
					'user_name' => $value['author_name'],
					'text' => $value['text'],
					'star' => $value['rating'],
					'time' => $value['time'],
					'type' => 'organization'
				]);

				Organization::where('id', $r->organization)->update(['rate' => Rate::getRateSchool($r->organization)]);
			}
		}

		return redirect()->back();
    }

    public function cron(){
    	$organizations = Organization::get();
    	$tasks = CronTask::orderBy('id', 'desc')->get();
        return view('admin.parser.cron', compact('organizations', 'tasks'));
    }

    public function add_task(Request $r){
    	CronTask::createTask($r);
    	return redirect()->back();
    }

    public function delete_task(Request $r){
    	CronTask::where('id', $r->id)->delete();
    	return redirect()->back();
    }
}
