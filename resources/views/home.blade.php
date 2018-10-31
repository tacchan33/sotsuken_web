@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title">Dashboard</h2>
	</div>
	<div class="panel-body">

		<table class="col-md-12">
			<tr>
				<th>ユーザ</th>
				<th>建物</th>
				<th>階数</th>
				<th>部屋</th>
				<th>dBm</th>
			</tr>
			@foreach( $users as $user )
				@if( isset($user->wifibeacon->accesspoint_id1) && isset($user->wifibeacon->accesspoint_id2) && isset($user->wifibeacon->accesspoint_id3) )
					<tr>
						<td>{{ $user->lastname."さん" }}</td>
						<td>{{ $user->wifibeacon->accesspoint1->building }}</td>
						<td>{{ $user->wifibeacon->accesspoint1->floor }}</td>
						<td>{{ $user->wifibeacon->accesspoint1->room }}</td>
						<td>{{ $user->wifibeacon->level1 }}</td>
					</tr>
					<tr>
						<td></td>
						<td>{{ $user->wifibeacon->accesspoint2->building }}</td>
						<td>{{ $user->wifibeacon->accesspoint2->floor }}</td>
						<td>{{ $user->wifibeacon->accesspoint2->room }}</td>
						<td>{{ $user->wifibeacon->level2 }}</td>
					</tr>
					<tr>
						<td></td>
						<td>{{ $user->wifibeacon->accesspoint3->building }}</td>
						<td>{{ $user->wifibeacon->accesspoint3->floor }}</td>
						<td>{{ $user->wifibeacon->accesspoint3->room }}</td>
						<td>{{ $user->wifibeacon->level3 }}</td>
					</tr>
				@endif
			@endforeach
		</table>

	</div>
</div>
@endsection
