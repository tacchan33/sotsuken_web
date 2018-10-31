<?php
namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Accesspoint extends Model
{
	//テーブル指定
	protected $table = 'accesspoint';
	//主キー指定、主キーのAI有無、主キーの型
	protected $primaryKey = 'id';
	public $incrementing = false;
	protected $keyType = 'string';
	//created_at・updated_atの自動更新、カラム名
	public $timestamps = true;
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	//変更不可カラム
	protected $guarded = [];

	//変更可能カラム
	protected $fillable = [
		'id','transmit_power','essid',
		'building','floor','room',
	];

	//モデルを配列などに変換するときに隠蔽されるカラム
	protected $hidden = [];

	public static function validator(array $data)
	{
		return Validator::make($data, [
			'id'			=>	'required|sometimes|string|min:17|max:17',
			'transmit_power'=>	'required|sometimes|numeric',
			'essid'			=>	'sometimes|max:32',
			'building'		=>	'required|sometimes|string|max:20',
			'floor'			=>	'required|sometimes|numeric|min:-128|max:127',
			'room'			=>	'required|sometimes|string|max:20',
			])->validate();
	}

	public function scanlog(){
		return $this->hasMany('App\Models\Database\Scanlog');
	}

}
