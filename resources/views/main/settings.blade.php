@extends('layouts.app')

@section('content')

<div class="content">
    <div class="settings">
        <div class="settings__colLeft">
            <div class="settings__avatar"><img src="{{ '/storage/profile_'.$account->id.'.jpg' }}"/></div>
        </div>
		<div class="settings__colRight">
            <div class="settings__name typo typo_h2">{{ $account->first_name }} {{ $account->middle_name }} {{ $account->last_name }}</div>

			{!! Form::open(['route' => 'main.updatesearch', 'class' => 'form']) !!}
            <div class="settings__search typo typo_h3">
                {{ Form::hidden('currentSearchQueryId', $currentSearch->id) }}

                Я {!! Form::select('self_position', $positions, $currentSearch->self_position_id) !!}, ищу {!! Form::select('search_position', $positionsWithEndings, $currentSearch->search_position_id) !!} на {!! Form::select('event', $events, $currentSearch->event_id) !!}
            </div>
            <div class="settings__about typo typo_h3">
                {!! Form::textarea('description', $currentSearch->description,['class' => 'form-control input-lg','placeholder' => 'Возможно, вам есть что добавить?', 'cols' => '', 'rows' => '']) !!}
            </div>
            {!! Form::submit('Сохранить', ['class' => 'button']) !!}
            {!! Form::close() !!}

            {!! Form::open(['route' => 'main.updaterefs', 'class' => 'form']) !!}
            <div class="settings__contacts">
                <table id="dynamic_table">

                @forelse ($account->accountRefs as $ref)
                    <tr>
                        <td><button type="button" class="settings__minus" onclick="document.getElementById('dynamic_table').deleteRow(parentNode.parentNode.rowIndex); deleteRow();"></button></td>
                        <td><input name="name[]" type="text" class="form-control" readonly="readonly" value="{{ $ref->reference }}"></input></td>
                    </tr>
                @empty
                @endforelse

                    <tr>
                        <td><button id="add"  class="settings__plus" type="button"></button></td>
                        <td><input name="name[]" type="text" class="form-control"></input></td>
                    </tr>
                </table>
                {!! Form::submit('Сохранить', ['class' => 'button']) !!}
            </div>
    		{!! Form::close() !!}
            <a class="settings__exit typo typo_h3" href="{{ route('welcome.logout') }}">Выйти</a>
        </div>

	</div>
</div>

@endsection

@section('jscontent')
<script>
var i = 1;

function deleteRow() {
    var len = document.getElementsByTagName('tr').length;
    var settingsNew = document.getElementById('settings__new');
    if (len < 4){
        settingsNew.classList.remove('settings__new_hidden')
    }
}

document.addEventListener("DOMContentLoaded", () => {
    var len = document.getElementsByTagName("tr")
    if (len == 4){
        var row = document.getElementById("settings__new")
        row.classList.add("settings__new_hidden")
    }
});

document.getElementById("add").addEventListener("click", function(){
    event.preventDefault();
    var table = document.getElementById("dynamic_table");
    var value = document.getElementById("new").value
    var len = document.getElementsByTagName("tr")
	var row = table.insertRow(len.length - 1);
	row.id = "row" + i;

    // Button column
	var newCell2 = row.insertCell(-1);
	var newButton = document.createElement("button");
	newButton.id = i;
	newButton.type = "button";
    newButton.className = "settings__minus";
	newButton.addEventListener("click", function() {
		var rowToDelete = document.getElementById("row" + newButton.id);
		table.deleteRow(rowToDelete.rowIndex);
        deleteRow();
	});
	newCell2.appendChild(newButton);

	// Button column
	var newCell1 = row.insertCell(-1);
	var newInput = document.createElement("input");
	newInput.name = "name[]";
	newInput.type = "text";
    newInput.disabled = true;
    newInput.value = value;
	newCell1.appendChild(newInput);

	i++;

    var len = document.getElementsByTagName("tr").length;
    var settingsNew = document.getElementById("settings__new");

    if (len >= 4){
        console.log('4');
        settingsNew.classList.add("settings__new_hidden");
    }
});
</script>
@endsection
