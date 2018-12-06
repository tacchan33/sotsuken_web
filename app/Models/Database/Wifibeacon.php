<?php
namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Wifibeacon extends Model
{
	//テーブル指定
	protected $table = 'wifibeacon';
	//主キー指定、主キーのAI有無、主キーの型
	protected $primaryKey = ['user_id','sequence'];
	public $incrementing = false;
	protected $keyType = 'int';
	//created_at・updated_atの自動更新、カラム名
	public $timestamps = false;

	//変更不可カラム
	protected $guarded = [];

	//変更可能カラム
	protected $fillable = [
		'user_id','sequence',
		'updated_at',
		'accesspoint_id', 'received_power',
	];

	//モデルを配列などに変換するときに隠蔽されるカラム
	protected $hidden = [];

	public static function validator(array $data)
	{
		return Validator::make($data, [
			'accesspoint_id'	=>	'nullable|string|min:17|max:17',
			'received_power'	=>	'nullable|numeric|max:0',
		 ])->validate();
	}

	public function user(){
		return $this->hasOne('App\Models\Database\User','id','user_id');
	}

	public function accesspoint(){
		return $this->belongsTo('App\Models\Database\Accesspoint','accesspoint_id','id');
	}


}
