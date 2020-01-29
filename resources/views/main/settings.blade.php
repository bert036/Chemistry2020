@extends('layouts.app')

@section('content')
<h1>Настройки</h1>

<div> {{ $account->first_name }} {{ $account->middle_name }} {{ $account->last_name }}</div>
<image width="100px" height="100px" background="red" src="{{ '/storage/profile_'.$account->id.'.jpg' }}"></image>

<h1>Параметры поиска</h1>

<div class="row">
	<div class="col">

		{!! Form::open(['route' => 'main.updatesearch', 'class' => 'form']) !!}

		<div class="form-group">
			{!! Form::label('self_position', 'Я',['class' => 'control-label']) !!}
			{!! Form::select('self_position', $positions, $currentSearch->self_position_id) !!}
		</div>
		
		{{ Form::hidden('currentSearchQueryId', $currentSearch->id) }}

		<div class="form-group">
			{!! Form::label('search_position', 'Ищу',['class' => 'control-label']) !!}
			{!! Form::select('search_position', $positions, $currentSearch->search_position_id) !!}
		</div>

		<div class="form-group">
			{!! Form::label('event', 'Событие',['class' => 'control-label']) !!}
			{!! Form::select('event', $events, $currentSearch->event_id) !!}
		</div>

		<div class="form-group">
			{!! Form::label('description', 'Описание',['class' => 'control-label']) !!} <br/>
			{!! Form::textarea('description', $currentSearch->description,['class' => 'form-control input-lg','placeholder' => 'Возможно, вам есть что добавить?']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::submit('Обновить', ['class' => 'btn btn-info btn-lg', 'style' => 'width: 30%']) !!}
		</div>

		{!! Form::close() !!}

	</div>
</div>

<h1>Контакты</h1>

<div class="row">
	<div class="col">

		{!! Form::open(['route' => 'main.updaterefs', 'class' => 'form']) !!}

		<table id="dynamic_table">
			
			
		@forelse ($account->accountRefs as $ref)
			<tr>
				<td><input name="name[]" type="text" class="form-control" readonly="readonly" value="{{ $ref->reference }}"></input></td>
				<td><button type="button" onclick="document.getElementById('dynamic_table').deleteRow(parentNode.parentNode.rowIndex);">-</button></td>
			</tr>
		@empty
		@endforelse
		
			<tr>
				<td><input name="name[]" type="text" class="form-control"></input></td>
				<td><button id="add" type="button" >+</button></td>
			</tr>
		</table>	
		
		<div class="form-group">
			{!! Form::submit('Обновить', ['class' => 'btn btn-info btn-lg', 'style' => 'width: 30%']) !!}
		</div>		

		{!! Form::close() !!}
	</div>
</div>

@endsection


@section('jscontent')
<script>
var i = 1;
document.getElementById("add").addEventListener("click", function()
{
	var table = document.getElementById("dynamic_table");
	var row = table.insertRow(-1);
	row.id = "row" + i;

	// Button column
	var newCell1 = row.insertCell(-1);
	var newInput = document.createElement("input");
	newInput.name = "name[]";
	newInput.type = "text";
	newInput.class = "form-control";
	newCell1.appendChild(newInput);
	
	// Button column
	var newCell2 = row.insertCell(-1);
	var newButton = document.createElement("button");
	newButton.id = i;
	newButton.type = "button";
	newButton.innerHTML = '-';
	newButton.addEventListener("click", function() {
		var rowToDelete = document.getElementById("row" + newButton.id);
		table.deleteRow(rowToDelete.rowIndex);
	});
	newCell2.appendChild(newButton);
	
	i++;
});
</script>
@endsection
