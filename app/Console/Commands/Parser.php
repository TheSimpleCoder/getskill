<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Organization;
use Rate;
use App\Admin\CronTask;

class Parser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:reviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse reviews from google';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		
			$tasks = CronTask::orderBy('id', 'desc')->get();
			foreach($tasks as $task)
			{
				try{
					$xml = simplexml_load_file('https://maps.googleapis.com/maps/api/place/textsearch/xml?query='. $task->tasc_name .'&sensor=true&key=AIzaSyAkQZ-kDwtkbeeLtHCNaizwSccifP4vWDU');
				
					$characters = 'https://maps.googleapis.com/maps/api/place/details/json?placeid='. $xml->result->place_id .'&key=AIzaSyAkQZ-kDwtkbeeLtHCNaizwSccifP4vWDU';
					$characters = file_get_contents($characters);
					$characters = json_decode($characters, true);


					foreach ($characters['result']['reviews'] as $value) {
						try{
							$info = Rate::where('time', $value['time'])->first();
							if(!$info){
								Rate::create([
									'user_id' => 0,
									'course_id' => 0,
									'organization_id' => $task->organization,
									'user_avatar' => $value['profile_photo_url'],
									'user_name' => $value['author_name'],
									'text' => $value['text'],
									'star' => $value['rating'],
									'time' => $value['time'],
									'type' => 'organization'
								]);

								Organization::where('id', $task->organization)->update(['rate' => Rate::getRateSchool($task->organization)]);
							}
						} catch (\Exception $e) {
							continue;		
						}
					}
				} catch (\Exception $e) {
					continue;		
				}
				
				//file_put_contents('/var/www/www-root/data/www/getskill.com.ua/0.txt', $task->tasc_name, FILE_APPEND);
			}
    }
}
