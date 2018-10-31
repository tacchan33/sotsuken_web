<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\Database\User;
use App\Models\Database\Wifibeacon;
use App\Models\Database\Accesspoint;
use App\Models\Database\Scanlog;

define('WIFIBEACON_MAX',3);

class HomeController extends Controller
{

    public function __construct(){ $this->middleware('auth'); }

	public function index()
	{
		$users = User::all();
		$accesspoint = Accesspoint::all();
		return view('home',[ 'users'=>$users , 'accesspoint'=>$accesspoint ]);
	}

	public function test(){
		/*int[] $diff = new int[WIFIBEACON_MAX];

		for( $i=0; $i<WIFIBEACON_MAX; $i++){
			$diff[$i] = null;
			$wifibeacons[$i] = Wifibeacon::where('sequence','=',$i)->get();
		}
		$scanlogs = Scanlog::select( DB::raw("accesspoint_id , AVG(received_power) as average ") )
							->groupBy('accesspoint_id')
							->get();

		foreach($wifibeacons[0] as $wifibeacon[0]){
			foreach($scanlogs as $scanlog){
				if($scanlog->accesspoint_id == $wifibeacon[0]->accesspoint_id){
					$diff[0] = $scanlog->average - $wifibeacon[0]->received_power;
				}else if($accesspoint->id == $wifibeacon[1]->accesspoint_id){
					$diff[1] = $scanlog->average - $wifibeacon[1]->received_power;
				}else if($accesspoint->id == $wifibeacon[2]->accesspoint_id){
					$diff[2] = $scanlog->average - $wifibeacon[2]->received_power;
				}
			}
			for($i=0; $i<WIFIBEACON_MAX-1;$i++){
				for($j=$i+1; $i<WIFIBEACON_MAX;$i++){
					if($diff[$i]<$diff[$j]){
						
					}
				}
			}
		}

		dd($wifibeacons);*/
	}
}
