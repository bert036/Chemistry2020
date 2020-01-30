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
