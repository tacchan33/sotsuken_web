<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Database\User;

class AccountController extends Controller
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
		'token' =>	[
			'color'	=>	'success',
			'message'	=> 'トークン変更'],

	];

	public function __construct(){ $this->middleware('auth'); }

	public function index()
	{
		return view('account.index');
	}

	public function form(Request $request){
		if( $request->action=="update" ){
			return view('account.update',[
				'user' => User::find(Auth::id()),
			]);
		}else if( $request->action=='passnumber' ){
			return view('account.passnumber');
		}else{
			return view('errors.404');
		}
	}

	public function update(Request $request)
	{
		User::validator( $request->all() );
		if( User::findOrFail( Auth::id() ) ){
			$user = User::findOrFail( Auth::id() );
			$user->fill([
				'email'	=>	$request->email,
				'lastname'	=>	$request->lastname,
				'firstname'	=>	$request->firstname,
				])->update();
			if( !empty($request->password) ){
				$user->update([ 'password'	=>	password_hash($request->password,PASSWORD_BCRYPT) ]);
			}
			return view('account.update',[
				'user'	=>	User::findOrFail( Auth::id() ),
				'result'	=>	$this->result['updated'],
			]);
		}else{
			return view('errors.404');
		}
	}

	public function passnumber()
	{
		if( User::findOrFail(Auth::id()) ){
			$token = User::updateDeviceToken(Auth::id());
			$this->result['token']['message'] = 'ビーコン更新用トークンを【'.$token.'】で再設定しました。';
			return view('account.passnumber',[
				'result'	=> $this->result['token'],
			]);
		}else{
			return view('errors.404');
		}
	}

}
