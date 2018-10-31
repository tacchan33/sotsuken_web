@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">注意</div>
	<div class="panel-body">Android端末から専用アプリをインストールして、そのアプリからアクセスして下さい。</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">フォーム</div>
	<div class="panel-body">

		@isset( $result )
			<div class="alert alert-{{ $result['color'] }}">
				<div class="alert-title">お知らせ</div>{{ $result['message'] }}
			</div>
		@endisset

	    <form class="form-horizontal" method="POST" action="{{ route('wifibeacon.update') }}">
			<input name="_method" type="hidden" value="PUT">
			<div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
				<label for="email" class="col-md-4 control-label">メールアドレス</label>
				<div class="col-md-6">
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
					@if ($errors->has('email'))
						<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('password') ? 'has-error' : '' }}">
				<label for="password" class="col-md-4 control-label">パスワード</label>
				<div class="col-md-6">
					<input id="password" type="password" class="form-control" name="password" required>
					@if ($errors->has('password'))
						<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
					@endif
			    </div>
			</div>

			<div class="form-group{{ $errors->has('device_token') ? 'has-error' : '' }}">
				<label for="password" class="col-md-4 control-label">デバイス用トークン</label>
				<div class="col-md-6">
					<input id="device_token" type="text" class="form-control" name="device_token" value="{{ old('device_token') }}" required>
					@if ($errors->has('device_token'))
						<span class="help-block"><strong>{{ $errors->first('device_token') }}</strong></span>
					@endif
			   </div>
			</div>

			<div class="form-group{{ $errors->has('accesspoint_id[0]') ? 'has-error' : '' }}">
				<label for="accesspoint_id[0]" class="col-md-4 control-label">BSSID1</label>
				<div class="col-md-6">
					<input id="accesspoint_id[0]" type="text" class="form-control" name="accesspoint_id[0]" value="{{ old('accesspoint_id[0]') }}">
					@if ($errors->has('accesspoint_id[0]'))
						<span class="help-block"><strong>{{ $errors->first('accesspoint_id[0]') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('received_power[0]') ? 'has-error' : '' }}">
				<label for="received_power[0]" class="col-md-4 control-label">受信電力1</label>
				<div class="col-md-6">
					<input id="received_power[0]" type="text" class="form-control" name="received_power[0]" value="{{ old('received_power[0]') }}">
					@if ($errors->has('received_power[0]'))
						<span class="help-block"><strong>{{ $errors->first('received_power[0]') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('accesspoint_id[1]') ? 'has-error' : '' }}">
				<label for="accesspoint_id[1]" class="col-md-4 control-label">BSSID1</label>
				<div class="col-md-6">
					<input id="accesspoint_id[1]" type="text" class="form-control" name="accesspoint_id[1]" value="{{ old('accesspoint_id[1]') }}">
					@if ($errors->has('accesspoint_id[1]'))
						<span class="help-block"><strong>{{ $errors->first('accesspoint_id[1]') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('received_power[1]') ? 'has-error' : '' }}">
				<label for="received_power[1]" class="col-md-4 control-label">受信電力1</label>
				<div class="col-md-6">
					<input id="received_power[1]" type="text" class="form-control" name="received_power[1]" value="{{ old('received_power[1]') }}">
					@if ($errors->has('received_power[1]'))
						<span class="help-block"><strong>{{ $errors->first('received_power[1]') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group" style="text-align: center;">
				<div class="col-xs-offset-2 col-xs-4 col-sm-offset-3 col-sm-3 col-md-offset-3 col-md-3">
					<button type="submit" class="btn btn-primary">変更</button>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-3">
					<button type="button" onclick="window.location='{{ route('home') }}'" class="btn btn-default">戻る</button>
				</div>
			</div>
		</form>

	</div>
</div>
@endsection
