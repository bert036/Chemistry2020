@extends('layouts.app')

@section('content')

<div class="bar bar_1"></div>

<div class="content">
    <div class="search typo typo_h1">
        <div class="typo typo_h1">Мои контакты</div>
		{!! Form::open(['route' => 'welcome.step3'], ['class' => 'form']) !!}
        <div class="settings__contacts">
            <table id="dynamic_table">
                <tbody>
                    <tr>
                        <td><button id="add" class="settings__plus"></button></td>
                        <td><input name="name[]" type="text" placeholder="Ссылка на контакты"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        {!! Form::submit() !!}
		{!! Form::close() !!}
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
