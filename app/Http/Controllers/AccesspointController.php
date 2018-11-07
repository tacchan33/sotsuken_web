<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Database\Accesspoint;

class AccesspointController extends Controller
{
	private $result = [
		'created' =>	[
			'color'	=>	'success',
			'message'	=> '以下の通り、登録しました。'],
		'updated' =>	[
			'color'	=>	'success',
			'message'	=> '以下の通り、変更しました。'],
		'deleted' =>	[
			'color'	=>	'success',
			'message'	=> '以下を削除しました。'],
		'danger' =>	[
			'color'	=>	'danger',
			'message'	=> '失敗しました。'],

	];

	public function __construct(){ $this->middleware('auth'); }

	public function index()
	{
		return view('accesspoint.index',[
			'accesspoints'	=>	Accesspoint::all()
		]);
	}

	public function form(Request $request)
	{
		if( $request->action=="create" && !isset($request->id) ){
			return view('accesspoint.create');
		}else if( $request->action=="update" && Accesspoint::findOrFail($request->id) ){
			return view('accesspoint.update',[
				'accesspoint'	=>	Accesspoint::findOrFail( $request->id ),
			]);
		}else if( $request->action=="delete" && Accesspoint::findOrFail($request->id) ){
			return view('accesspoint.delete',[
				'accesspoint'	=>	Accesspoint::findOrFail( $request->id ),
			]);
		}else{
			return view('errors.404');
		}
	}

	public function create(Request $request)
	{
		Accesspoint::validator( $request->all() );
		if( !Accesspoint::find($request->id) ){
			$accesspoint = Accesspoint::create( $request->all() );
			return view('accesspoint.update',[
				'result'	=>	$this->result['created'],
				'accesspoint'	=>	Accesspoint::findOrFail( $accesspoint->id ),
			]);
		}else{
			return view('errors/403');
		}
	}

	public function update(Request $request)
	{
		Accesspoint::validator( $request->all() );
		if( Accesspoint::findOrFail($request->id) ){
			$accesspoint = Accesspoint::findOrFail( $request->id );
			$accesspoint->fill( $request->all() )->save();
			return view('accesspoint.update',[
				'result'	=>	$this->result['updated'],
				'accesspoint'	=>	Accesspoint::findOrFail( $request->id ),
			]);
		}else{
			return view('errors/404');
		}
	}

	public function delete(Request $request)
	{
		Accesspoint::validator( $request->All() );
		if( Accesspoint::findOrFail($request->id) && $request->input('confirm') ){
			$delete = Accesspoint::find($request->id);
			$this->result['deleted']['message']	= $delete->id.'を削除しました。';
			Accesspoint::findOrFail($request->id)->delete();
			return view('accesspoint.index',[
				'result' => $this->result['deleted'],
				'accesspoints' => Accesspoint::orderBy('id','asc')->orderBy('building','asc')->orderBy('floor','asc')->get()
			]);
		}else{
				return view('errors.404');
		}
	}

}
