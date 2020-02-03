@extends('layouts.app')

@section('content')

<div class="bar bar_1"></div>

<div class="content">
	<div class="search typo typo_h1">

		{!! Form::open(['route' => 'welcome.step1b'], ['class' => 'form']) !!}

		<div class="search__line">
			Я {!! Form::select('self_position', $positions, null) !!},
		</div>

		<div class="search__line">
			ищу {!! Form::select('search_position', $positionsWithEndings, '2') !!}
		</div>

		<div class="search__line">
			на {!! Form::select('event', $events, null) !!}
		</div>

		{!! Form::submit() !!}

		{!! Form::close() !!}

	</div>
</div>

@endsection
