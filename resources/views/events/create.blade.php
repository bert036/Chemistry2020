@extends('layouts.app')

@section('content')

<h1>Новое событие</h1>

<div class="row">
	<div class="col">

		{!! Form::open(['route' => 'events.store'], ['class' => 'form']) !!}

		<div class="form-group">
			{!! Form::label('description', 'Описание',['class' => 'control-label']) !!} <br/>
			{!! Form::textarea('description', null,['class' => 'form-control input-lg','placeholder' => 'Опишите событие ...']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('start_date', 'Начало', ['class' => 'control-label']) !!}
			{!! Form::date('start_date', null) !!}
		</div>

		<div class="form-group">
			{!! Form::label('end_date', "Окончание", ['class' => 'control-label'])!!}
			{!! Form::date('end_date', null) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Создать', ['class' => 'btn btn-info btn-lg', 'style' => 'width: 100%']) !!}
		</div>

		{!! Form::close() !!}

	</div>
</div>

@endsection