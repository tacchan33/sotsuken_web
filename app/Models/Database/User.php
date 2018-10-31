<?php
namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class User extends Model
{
	//テーブル指定
	protected $table = 'user';
	//主キー指定、主キーのAI有無、主キーの型
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'int';
	//created_at・updated_atの自動更新、カラム名
	public $timestamps = true;
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	//変更不可カラム
	protected $guarded = [
		'id',
	];

	//変更可能カラム
	protected $fillable = [
		'email','password',
		'lastname', 'firstname',
		'device_token',
	];

	//モデルを配列などに変換するときに隠蔽されるカラム
	protected $hidden = [
		'password', 'remember_token',
	];

	public static function validator(array $data)
	{
		return Validator::make($data, [
			'email'			=>	['required','sometimes','string','email','max:255',Rule::unique('user')->ignore(Auth::id()) ],
			'password'		=>	'confirmed|nullable|string|min:6|max:255',
			'*name'			=>	'required|sometimes|string|min:1|max:255',
		 ])->validate();
	}

	public function wifibeacon(){
		return $this->hasOne('App\Models\Database\Wifibeacon');
	}

	/**********************************/
	//	updateDeviceToken()
	//	ログイン必須
	//	トークンは6桁発行
	public static function updateDeviceToken( $user_id )
	{
		$device_token = "";//初期化
		mt_srand();
		for($i=0;$i<6;$i++){
			$device_token = $device_token . mt_rand(0,9);
		}

		DB::table('user')
			->where( 'id' , $user_id )
			->update(['device_token' => password_hash($device_token,PASSWORD_BCRYPT)]);

		return $device_token;
	}

}
