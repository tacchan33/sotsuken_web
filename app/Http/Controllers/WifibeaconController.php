<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Database\Wifibeacon;
use App\Models\Database\User;
use App\Models\Database\Accesspoint;
use App\Models\Database\Scanlog;

define('WIFIBEACON_MAX',3);

class WifibeaconController extends Controller
{
	private $result = [
		'created' =>	[
			'color'	=>	'success',
			'message'	=> '以下の通り、登録しました。'],
		'updated' =>	[
			'color'	=>	'success',
			'message'	=> 'データを更新しました'],
		'deleted' =>	[
			'color'	=>	'success',
			'message'	=> '以下を削除しました。'],
		'danger' =>	[
			'color'	=>	'danger',
			'message'	=> '失敗しました。'],
		'notVerify' =>	[
			'color'	=>	'danger',
			'message'	=> 'メールアドレスまたはパスワードが一致しません。'],
		'notToken' =>	[
			'color'	=>	'danger',
			'message'	=> '端末用トークンが合いません'],

	];

	public function form(Request $request){
		return view('wifibeacon.update');
	}

	public function update(Request $request){
		Wifibeacon::validator($request->All());
		for( $i=0; $i<WIFIBEACON_MAX; $i++){
			if( !empty($request->accesspoint_id[$i]) ){
				if( !Accesspoint::find( $request->accesspoint_id[$i]) ){
					Accesspoint::create([
						'id'				=>	$request->accesspoint_id[$i],
						'transmit_power'	=>	'0',
						'essid'				=>	$request->essid[$i],
						'building'			=>	'不明',
						'floor'				=>	'0',
						'room'				=>	'不明',
					]);
				}
			}
		}

		if( !empty($request->accesspoint_id[0]) && !empty($request->received_power[0]) ){
			Scanlog::create([
				'accesspoint_id'	=>	$request->accesspoint_id[0],
				'received_power'	=>	$request->received_power[0],
				]);
		}

		$user = User::where( 'email' , '=' , $request->input('email') )->first();
		if( $user != null && password_verify($request->input('password'),$user->password) ){
			if( password_verify($request->input('device_token'),$user->device_token) ){
				$time = date('Y/m/d G:i:s');
				for( $i=0; $i<WIFIBEACON_MAX ; $i++){

					$wifibeacon = Wifibeacon::where( 'user_id' , '=' , $user->id )
											->where( 'sequence' , '=' , $i )
											->first();

					if( isset($request->accesspoint_id[$i]) ){
						if( $wifibeacon != null ){
							Wifibeacon::where( 'user_id' , '=' , $user->id )
										->where( 'sequence' , '=' , $i )
										->update([
											'updated_at'		=>	$time,
											'accesspoint_id'	=>	$request->accesspoint_id[$i],
											'received_power'	=>	$request->received_power[$i],
											]);
						}else{
							Wifibeacon::create([
								'user_id'			=>	$user->id,
								'sequence'			=>	$i,
								'updated_at'		=>	$time,
								'accesspoint_id'	=>	$request->accesspoint_id[$i],
								'received_power'	=>	$request->received_power[$i],
								]);
						}
					}else if( $wifibeacon != null ){
						Wifibeacon::where( 'user_id' , '=' , $user->id )
									->where( 'sequence' , '=' , $i )
									->delete();
					}
				}

				$result = $this->result['updated'];
			}else{
				$result = $this->result['notToken'];
			}
		}else{
			$result = $this->result['notVerify'];
		}

		return view('wifibeacon.update', [
			'result' => $result]);
	}
}
