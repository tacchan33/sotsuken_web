@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title">スキャンログ 一覧</h2>
	</div>
	<div class="panel-body">

		@isset( $result )
			<div class="alert alert-{{ $result['color'] }}">
		 	   <div class="alert-title">お知らせ</div>{{ $result['message'] }}
			</div>
		@endisset

		<table class="table form-group">
			<tr>
				<th>取得時間</th>
				<th>BSSID</th>
				<th>受信電力</th>
				<th></th>
			</tr>
			@foreach ($scanlogs as $scanlog)
				<tr>
					<td>{{ $scanlog->created_at }}</td>
					<td>{{ $scanlog->accesspoint_id }}</td>
					<td>{{ $scanlog->received_power }}</td>
					<td class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
							メニュー <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="">削除</a>
							</li>
						</ul>
					</td>
				</tr>
			@endforeach
		</table>

		<hr>

		<table class="table form-group">
			<tr>
				<th>BSSID</th>
				<th>取得回数</th>
				<th>平均受信電力</th>
			</tr>
			@isset($statistics)
			@foreach ($statistics as $statistic)
				<tr>
					<td>{{ $statistic->accesspoint_id }}</td>
					<td>{{ $statistic->count }}</td>
					<td>{{ $statistic->average }}</td>
				</tr>
			@endforeach
			@endisset
		</table>

	</div>
</div>
@endsection
