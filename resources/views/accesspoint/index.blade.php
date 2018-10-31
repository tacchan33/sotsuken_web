@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title">アクセスポイント 一覧</h2>
	</div>
	<div class="panel-body">

		@isset( $result )
			<div class="alert alert-{{ $result['color'] }}">
		 	   <div class="alert-title">お知らせ</div>{{ $result['message'] }}
			</div>
		@endisset

		<div class="form-group">
			<div class="col-md-12" style="text-align:right">
				<p><a href="{{ route('accesspoint.form',[ 'action'=>'create' ]) }}">新規追加</a></p>
			</div>
		</div>

		<table class="table form-group">
			<tr>
				<th>BSSID</th>
				<th>送信電力</th>
				<th>建物名</th>
				<th>階数</th>
				<th>部屋</th>
				<th>最終更新日</th>
				<th></th>
			</tr>
			@foreach ($accesspoints as $accesspoint)
				<tr>
					<td>{{ $accesspoint->id }}</td>
					<td>{{ $accesspoint->transmit_power }}</td>
					<td>{{ $accesspoint->building }}</td>
					<td>{{ $accesspoint->floor }}</td>
					<td>{{ $accesspoint->room }}</td>
					<td>{{ $accesspoint->updated_at }}</td>
					<td class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
							メニュー <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('accesspoint.form',[ 'action'=>'update' , 'id'=>$accesspoint->id ]) }}">表示変更</a>
								<a href="{{ route('accesspoint.form',[ 'action'=>'delete' , 'id'=>$accesspoint->id ]) }}">削除</a>
							</li>
						</ul>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@endsection
