@extends('layouts.app')

@section('content')
<h1>Новая позиция</h1>

<div class="row">
	<div class="col">

		{!! Form::open(['route' => 'positions.store'], ['class' => 'form']) !!}

		<div class="form-group">
			{!! Form::label('description', 'Описание',['class' => 'control-label']) !!} <br/>
			{!! Form::textarea('description', null,['class' => 'form-control input-lg','placeholder' => 'Опишите позицию ...']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('Order', 'Вес',['class' => 'control-label']) !!} <br/>
			{!! Form::text('order', null,['class' => 'form-control input-lg','placeholder' => 'Вес позиции ...']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Создать', ['class' => 'btn btn-info btn-lg', 'style' => 'width: 30%']) !!}
		</div>

		{!! Form::close() !!}

	</div>
</div>

@endsection