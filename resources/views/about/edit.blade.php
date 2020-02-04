@extends('layouts.app')

@section('content')

<div class="content">
    <div class="about">
		
			{!! Form::open(['route' => 'about.update', 'class' => 'form']) !!}

            <div class="typo typo_h2">
                {!! Form::textarea('description', $description->content,['class' => 'form-control input-lg','placeholder' => 'Возможно, вам есть что добавить?', 'cols' => '', 'rows' => '']) !!}
            </div>
            
			<div class="settings__contacts">
                <table id="dynamic_table">

                @forelse ($refs as $ref)
                    <tr>
                        <td><button type="button" class="settings__minus" onclick="document.getElementById('dynamic_table').deleteRow(parentNode.parentNode.rowIndex); deleteRow();"></button></td>
                        <td><input name="ref[]" type="text" class="form-control" readonly="readonly" value="{{ $ref->content }}"></input></td>
						<td><input name="add[]" type="text" class="form-control" readonly="readonly" value="{{ $ref->addition }}"></input></td>
                    </tr>
                @empty
                @endforelse

                    <tr>
                        <td><button id="add"  class="settings__plus" type="button"></button></td>
                        <td><input name="ref[]" type="text" class="form-control"></input></td>
						<td><input name="add[]" type="text" class="form-control"></input></td>
                    </tr>
                </table>
            </div>
			
			
			{!! Form::submit('Сохранить', ['class' => 'button']) !!}
            {!! Form::close() !!}

            <a class="settings__exit typo typo_h3" href="{{ route('welcome.logout') }}">Выйти</a>

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

	// Input for content column
	var newCell1 = row.insertCell(-1);
	var newInput = document.createElement("input");
	newInput.name = "ref[]";
	newInput.type = "text";
    newInput.disabled = true;
    newInput.value = value;
	newCell1.appendChild(newInput);
	
	// Input for additional column
	var newCell1 = row.insertCell(-1);
	var newInput = document.createElement("input");
	newInput.name = "add[]";
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
