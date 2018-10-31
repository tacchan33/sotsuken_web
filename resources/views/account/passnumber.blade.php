@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class='panel-title'>端末用トークン</h2>
	</div>
	<div class="panel-body">
		@isset( $result )
			<div class="alert alert-{{ $result['color'] }}">
				<div class="alert-title">お知らせ</div>{{ $result['message'] }}
			</div>
		@endisset

	    <form class="form-horizontal" method="POST" action="{{ route('account.passnumber') }}">
			{{ method_field('PUT') }}
			{{ csrf_field() }}

			<div class="form-group">
				<div class="col-md-10 col-md-offset-1">
					<strong>　端末用トークンとは、Android端末で専用アプリにてWi-Fiビーコン情報を送信する際に用いる一時的なパスワードです。<br>トークンは更新をするたびに、ランダムに生成され、以前のトークンは使えなくなります。<br>それでも良いですか？</strong>
				</div>
			</div>

			<div class="form-group">
				<label for="confirm" class="col-md-4 control-label">同意します</label>
				<div class="col-md-6">
					<input id="confirm" type="checkbox" class="form-control" name="confirm" required>
			    </div>
			</div>

			<div class="form-group" style="text-align:center">
			    <div class="col-md-offset-3 col-md-3">
					<button type="submit" class="btn btn-primary">更新</button>
			    </div>
			    <div class="col-md-3">
					<button type="button" class="btn" onclick="window.location='{{ route('account.index') }}'">戻る</button>
			    </div>
			</div>

		</form>

	</div>
</div>
@endsection
