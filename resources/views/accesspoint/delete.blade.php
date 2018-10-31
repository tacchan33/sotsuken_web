@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title">アクセスポイント　削除</h2>
	</div>
	<div class="panel-body">

	    <form class="form-horizontal" method="POST" action="{{ route('accesspoint.delete') }}">
			{{ method_field('DELETE') }}
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('id') ? 'has-error' : '' }}">
				<label for="id" class="col-md-4 control-label">BSSID＊</label>
				<div class="col-md-6">
					<input id="id" type="text" class="form-control" name="id" value="{{ $accesspoint->id }}" readonly>
					@if ($errors->has('id'))
						<span class="help-block"><strong>{{ $errors->first('id') }}</strong></span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">送信電力(AP周囲1m計測)＊</label>
				<div class="col-md-6">
					<input type="text" class="form-control" value="{{ $accesspoint->transmit_power }}" readonly>
			    </div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">ESSID</label>
				<div class="col-md-6">
					<input type="text" class="form-control" value="{{ $accesspoint->essid }}" readonly>
			    </div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">建物名＊</label>
				<div class="col-md-6">
					<input type="text" class="form-control" value="{{ $accesspoint->building }}" readonly>
			   </div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">階数＊</label>
				<div class="col-md-6">
					<input type="text" class="form-control" value="{{ $accesspoint->floor }}" readonly>
			    </div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">部屋名＊</label>
				<div class="col-md-6">
					<input type="text" class="form-control" value="{{ $accesspoint->room }}">
			    </div>
			</div>

			<div class="form-group">
				<p class="col-md-12  control-label" style="text-align:center;">データを削除すると復元できません。よろしいですか？</p>
                <div class="col-md-12" style="text-align:center;">
                    <div class="checkbox">
                        <label><input type="checkbox" name="confirm" value="true" required> 同意</label>
                    </div>
                </div>
            </div>

			<div class="form-group" style="text-align: center;">
				<div class="col-xs-offset-2 col-xs-4 col-sm-offset-3 col-sm-3 col-md-offset-3 col-md-3">
					<button type="submit" class="btn btn-primary">削除</button>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-3">
					<button type="button" onclick="window.location='{{ route('accesspoint.index') }}'" class="btn btn-default">戻る</button>
				</div>
			</div>

		</form>

	</div>
</div>
@endsection
