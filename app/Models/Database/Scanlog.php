<?php
namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Scanlog extends Model
{
	//テーブル指定
	protected $table = 'scanlog';
	//主キー指定、主キーのAI有無、主キーの型
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'int';
	//created_at・updated_atの自動更新、カラム名
	public $timestamps = true;
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	//変更不可カラム
	protected $guarded = [];

	//変更可能カラム
	protected $fillable = [
		'accesspoint_id',
		'received_power',
	];

	//モデルを配列などに変換するときに隠蔽されるカラム
	protected $hidden = [];

	public static function validator(array $data)
	{
		return Validator::make($data, [
			'id'				=>	'required|sometimes|numeric',
			'accesspoint_id'	=>	'required|sometimes|string',
			'received_power'	=>	'required|sometimes',
		 ])->validate();
	}

	public function accesspoint(){
		return $this->belongsTo('App\Models\Database\Accesspoint');
	}

}
