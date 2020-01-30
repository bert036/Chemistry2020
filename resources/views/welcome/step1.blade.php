@extends('layouts.app')

@section('content')

<h1>Вы ищете ...</h1>

<div class="row">
	<div class="col">

		{!! Form::open(['route' => 'welcome.step2'], ['class' => 'form']) !!}

		<div class="form-group">
			{!! Form::label('self_position', 'Я',['class' => 'control-label']) !!}
			{!! Form::select('self_position', $positions, null) !!}
		</div>

		<div class="form-group">
			{!! Form::label('search_position', 'Ищу',['class' => 'control-label']) !!}
			{!! Form::select('search_position', $positionsWithEndings, '2') !!}
		</div>

		<div class="form-group">
			{!! Form::label('event', 'Событие',['class' => 'control-label']) !!}
			{!! Form::select('event', $events, null) !!}
		</div>

		<div class="form-group">
			{!! Form::label('description', 'Описание',['class' => 'control-label']) !!} <br/>
			{!! Form::textarea('description', null,['class' => 'form-control input-lg','placeholder' => 'Возможно, вам есть что добавить?']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::submit('Далее', ['class' => 'btn btn-info btn-lg', 'style' => 'width: 30%']) !!}
		</div>

		{!! Form::close() !!}

	</div>
</div>

@endsection