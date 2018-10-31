@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class='panel-title'>個人情報変更</h2>
	</div>
	<div class="panel-body">
		@isset( $result )
			<div class="alert alert-{{ $result['color'] }}">
				<div class="alert-title">お知らせ</div>{{ $result['message'] }}
			</div>
		@endisset

		<form class="form-horizontal" method="POST" action="{{ route('account.update') }}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-md-4 control-label">メールアドレス＊</label>
				<div class="col-md-6">
					<input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
					@if ($errors->has('email'))
						<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
				<label for="lastname" class="col-md-4 control-label">姓＊</label>
				<div class="col-md-6">
					<input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
					@if ($errors->has('lastname'))
						<span class="help-block"><strong>{{ $errors->first('lastname') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
				<label for="firstname" class="col-md-4 control-label">名＊</label>
				<div class="col-md-6">
					<input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}">
					@if ($errors->has('firstname'))
						<span class="help-block"><strong>{{ $errors->first('firstname') }}</strong></span>
					@endif
				</div>
			</div>

			<hr>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="password" class="col-md-4 control-label">パスワード(6文字以上)</label>
				<div class="col-md-6">
					<input id="password" type="password" class="form-control" name="password">
					@if ($errors->has('password'))
						<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label for="password-confirm" class="col-md-4 control-label">パスワード(確認)</label>
				<div class="col-md-6">
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation">
				</div>
			</div>

			<div class="form-group" style="text-align:center">
				<div class="col-md-3 col-md-offset-3">
					<button type="submit" class="btn btn-primary">更新</button>
				</div>
				<div class="col-md-3">
					<button type="reset" class="btn btn-default" onclick="window.location='{{ route('account.index') }}'">戻る</button>
				</div>
			</div>

		</form>

	</div>
</div>
@endsection
