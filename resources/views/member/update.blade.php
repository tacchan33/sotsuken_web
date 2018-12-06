@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title">メンバー 表示・更新</h2>
	</div>
	<div class="panel-body">

		@isset( $result )
			<div class="alert alert-{{ $result['color'] }}">
		 	   <div class="alert-title">お知らせ</div>{{ $result['message'] }}
			</div>
		@endisset

		<form class="form-horizontal" method="POST" action="">
			{{ method_field('PUT') }}
			{{ csrf_field() }}

			<div class="form-group">
				<p class="col-md-12" style='text-align:right;'>最終更新日時：{{ $wifibeacon->updated_at }}</p>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">姓</label>
				<div class="col-md-6">
					<input type="text" class="form-control" value="{{ $user->lastname }}" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">名</label>
				<div class="col-md-6">
					<input type="text" class="form-control" value="{{ $user->firstname }}" readonly>
				</div>
			</div>

		</form>

		<table class="col-md-12">
			<tr>
				<th>BSSID</th>
				<th>ESSID</th>
				<th>建物名</th>
				<th>階数</th>
				<th>部屋名</th>
			</tr>
			<tr>
				<td>{{ $accesspoint->id }}</td>
				<td>{{ $accesspoint->essid }}</td>
				<td>{{ $accesspoint->building }}</td>
				<td>{{ $accesspoint->floor }}</td>
				<td>{{ $accesspoint->room }}</td>
			</tr>
		</table>

	</div>
</div>
@endsection
