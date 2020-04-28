@extends('layouts.app')

@section('content')

<h1>Новое событие</h1>

<div class="row">
	<div class="col">

		{!! Form::open(['route' => 'common.update'], ['class' => 'form']) !!}

		<div class="form-group">
			{!! Form::label('description', 'О проекте',['class' => 'control-label']) !!} <br/>
			{!! Form::textarea('description', $item ? $item->description : null,['class' => 'form-control input-lg','placeholder' => 'О проекте ...']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Обновить', ['class' => 'btn btn-info btn-lg', 'style' => 'width: 100%']) !!}
		</div>

		{!! Form::close() !!}

	</div>
</div>

@endsection