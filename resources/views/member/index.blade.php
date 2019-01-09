@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title">メンバー</h2>
	</div>
	<div class="panel-body">

		<table class="col-md-12">
			<tr>
				<th>名前</th>
				<th></th>
			</tr>
			@foreach( $users as $user )
				<tr>
					<td>{{ $user->lastname.' '.$user->firstname }}</td>
					<td class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
							メニュー <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('member.form',[ 'action'=>'update' , 'id'=>$user->id ]) }}">表示</a>
							</li>
						</ul>
					</td>
				</tr>
			@endforeach
		</table>

	</div>
</div>
@endsection
