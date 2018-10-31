@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title">アクセスポイント　変更</h2>
	</div>
	<div class="panel-body">

		@isset( $result )
			<div class="alert alert-{{ $result['color'] }}">
		 	   <div class="alert-title">お知らせ</div>{{ $result['message'] }}
			</div>
		@endisset

	    <form class="form-horizontal" method="POST" action="{{ route('accesspoint.update') }}">
			{{ method_field('PUT') }}
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('id') ? 'has-error' : '' }}">
				<label for="id" class="col-md-4 control-label">BSSID＊</label>
				<div class="col-md-6">
					<input id="id" type="text" class="form-control" name="id" value="{{ $accesspoint->id }}">
					@if ($errors->has('id'))
						<span class="help-block"><strong>{{ $errors->first('id') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('transmit_power') ? 'has-error' : '' }}">
				<label for="transmit_power" class="col-md-4 control-label">送信電力(AP周囲1m計測)＊</label>
				<div class="col-md-6">
					<input id="transmit_power" type="text" class="form-control" name="transmit_power" value="{{ $accesspoint->transmit_power }}">
					@if ($errors->has('transmit_power'))
						<span class="help-block"><strong>{{ $errors->first('transmit_power') }}</strong></span>
					@endif
			    </div>
			</div>

			<div class="form-group{{ $errors->has('essid') ? 'has-error' : '' }}">
				<label for="essid" class="col-md-4 control-label">ESSID</label>
				<div class="col-md-6">
					<input id="essid" type="text" class="form-control" name="essid" value="{{ $accesspoint->essid }}">
					@if ($errors->has('essid'))
						<span class="help-block"><strong>{{ $errors->first('essid') }}</strong></span>
					@endif
			    </div>
			</div>

			<div class="form-group{{ $errors->has('building') ? 'has-error' : '' }}">
				<label for="building" class="col-md-4 control-label">建物名＊</label>
				<div class="col-md-6">
					<input id="building" type="text" class="form-control" name="building" value="{{ $accesspoint->building }}">
					@if ($errors->has('building'))
						<span class="help-block"><strong>{{ $errors->first('building') }}</strong></span>
					@endif
			   </div>
			</div>

			<div class="form-group{{ $errors->has('floor') ? 'has-error' : '' }}">
				<label for="floor" class="col-md-4 control-label">階数＊</label>
				<div class="col-md-6">
					<input id="floor" type="text" class="form-control" name="floor" value="{{ $accesspoint->floor }}">
					@if ($errors->has('floor'))
						<span class="help-block"><strong>{{ $errors->first('floor') }}</strong></span>
					@endif
			    </div>
			</div>

			<div class="form-group{{ $errors->has('room') ? 'has-error' : '' }}">
				<label for="room" class="col-md-4 control-label">部屋名＊</label>
				<div class="col-md-6">
					<input id="room" type="text" class="form-control" name="room" value="{{ $accesspoint->room }}">
					@if ($errors->has('room'))
						<span class="help-block"><strong>{{ $errors->first('room') }}</strong></span>
					@endif
			    </div>
			</div>

			<div class="form-group" style="text-align: center;">
				<div class="col-xs-offset-2 col-xs-4 col-sm-offset-3 col-sm-3 col-md-offset-3 col-md-3">
					<button type="submit" class="btn btn-primary">変更</button>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-3">
					<button type="button" onclick="window.location='{{ route('accesspoint.index') }}'" class="btn btn-default">戻る</button>
				</div>
			</div>

		</form>

	</div>
</div>
@endsection
