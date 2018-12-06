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
		'verify' =>	[
			'color'	=>	'success',
			'message'	=> '認証成功'],
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

		/* accesspointテーブルに存在しないBSSIDを持つAPを追加する */
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

		/* scanlogテーブルに一番電波強度のあるビーコンをログに残す */
		if( !empty($request->accesspoint_id[0]) && !empty($request->received_power[0]) ){
			Scanlog::create([
				'accesspoint_id'	=>	$request->accesspoint_id[0],
				'received_power'	=>	$request->received_power[0],
				]);
		}

		/* 認証後、wifibeaconテーブルにビーコンを挿入する */
		$user = User::where( 'email' , '=' , $request->input('email') )->first();
		if( $user != null && password_verify($request->input('password'),$user->password) ){
			if( password_verify($request->input('device_token'),$user->device_token) ){
				if($request->input('update')){
					$time = date('Y/m/d G:i:s');
					for( $i=0; $i<WIFIBEACON_MAX ; $i++){

						$wifibeacon = Wifibeacon::where( 'user_id' , '=' , $user->id )
												->where( 'sequence' , '=' , $i )
												->first();

						if( !empty($request->accesspoint_id[$i]) && !empty($request->received_power[$i]) ){
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
					$result = $this->result['verify'];
				}
			}else{
				return response()->view( 'wifibeacon.update' ,[ 'result'=>$this->result['notToken'] ], 400 );
			}
		}else{
			return response()->view( 'wifibeacon.update' ,[ 'result'=>$this->result['notVerify'] ], 400 );
		}

		return view('wifibeacon.update', [
			'result' => $result]);
	}
}
