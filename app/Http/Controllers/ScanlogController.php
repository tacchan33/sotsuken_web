<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Database\Accesspoint;
use App\Models\Database\Scanlog;

class ScanlogController extends Controller
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
		return view('scanlog.index',[
			'scanlogs'	=>	Scanlog::orderBy('created_at','desc')->take(15)->get(),
			'statistics'=>	Scanlog::select( DB::raw("accesspoint_id , COUNT(accesspoint_id) as count, AVG(received_power) as average ") )
									->groupBy('accesspoint_id')
									->get()
		]);
	}

}
