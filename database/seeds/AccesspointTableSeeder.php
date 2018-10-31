<?php

use Illuminate\Database\Seeder;

class AccesspointTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$accesspoint = [
            [	'id'	        =>	'00:00:00:00:00:00',
                'created_at'	=>	'2018-10-19 00:00:00',
                'updated_at'	=>	'2018-10-19 00:00:00',
                'essid'         =>  '不明',
                'building'      =>  '不明',
                'floor'         =>  '0',
                'room'          =>  '不明',
            ],
		];
		
		DB::table('accesspoint')->insert($accesspoint);
	}
}
