<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

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
		return view('member.index',[ 'users'=>$users , 'accesspoint'=>$accesspoint ]);
	}

	public function form(Request $request)
	{
		if( $request->action=='update' && User::findOrFail( $request->id ) ){
			$wifibeacons = Wifibeacon::where('user_id','=',$request->id)->get();
			$scanlogs = Scanlog::select( DB::raw("accesspoint_id , COUNT(accesspoint_id) as count, AVG(received_power) as average ") )
										->groupBy('accesspoint_id')
										->get();

			$bestSequence = null;
			$bestPower = null;
			foreach( $wifibeacons as $wifibeacon ){
				foreach( $scanlogs as $scanlog ){
					if( $wifibeacon->accesspoint_id == $scanlog->accesspoint_id ){
						// 受信電力 - アクセスポイント毎の平均受信電力
						echo '['.$wifibeacon->sequence.']'.$wifibeacon->received_power.' ー '.$scanlog->average.' ＝ '.($wifibeacon->received_power-$scanlog->average).'<br>';
						if( is_null($bestPower) || $bestPower < ($wifibeacon->received_power - $scanlog->average) ){
							$bestPower = $wifibeacon->received_power - $scanlog->average;
							$bestSequence = $wifibeacon->sequence;
						}
					}
				}
			}

			echo '一番は'.$bestSequence.'<br>';

			$wifibeacon = Wifibeacon::where('user_id','=',$request->id)->where('sequence','=',$bestSequence)->first();
			return view('member.update',[
				'user'			=>	User::find($request->id),
				'accesspoint'	=>	Accesspoint::find($wifibeacon->accesspoint_id),
				]);
		}else{
			return view('errors.404');
		}

	}

}
