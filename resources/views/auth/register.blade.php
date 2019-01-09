@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">新規登録</div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="lastname" class="col-md-4 control-label">姓</label>
                <div class="col-md-6">
                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>
                    @if ($errors->has('lastname'))
                        <span class="help-block"><strong>{{ $errors->first('lastname') }}</strong></span>
                    @endif
                </div>
            </div>

			<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
			    <label for="firstname" class="col-md-4 control-label">名</label> 
                <div class="col-md-6">
				    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required>
                    @if ($errors->has('firstname'))
				        <span class="help-block"><strong>{{ $errors->first('firstname') }}</strong></span>
				    @endif
			    </div>
			</div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">メールアドレス</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">パスワード(6文字以上)</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">パスワード(確認)</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </div>
            
        </form>

    </div>
</div>
@endsection
