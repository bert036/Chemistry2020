@extends('layouts.app')

@section('content')
<h1>Редактировать позицию</h1>

<div class="row">
	<div class="col">

		{!! Form::model($position, ['method' => 'put', 'route' => ['positions.update', $position->id], 'class' => 'form']) !!}

		<div class="form-group">
			{!! Form::label('description', 'Описание',['class' => 'control-label']) !!} <br/>
			{!! Form::textarea('description', null,['class' => 'form-control input-lg','placeholder' => 'Опишите позицию ...']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('order', 'Вес', ['class' => 'control-label']) !!}
			{!! Form::text('order', null,['class' => 'form-control input-lg','placeholder' => 'Вес позиции ...']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::submit('Обновить', ['class' => 'btn btn-info btn-lg', 'style' => 'width: 30%']) !!}
		</div>
		
		{!! Form::close() !!}

	</div>
</div>

@endsection