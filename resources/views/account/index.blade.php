@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class='panel-title'>個人設定</h2>
	</div>
	<div class="panel-body">
		<ul>
			<li><a href="{{ route('account.form',[ 'action'=>'update' ]) }}">個人情報変更</a></li>
			<li><a href="{{ route('account.form',[ 'action'=>'passnumber' ]) }}">端末用トークン変更</a></li>
		</ul>
	</div>
</div>
@endsection
