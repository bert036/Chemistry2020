@extends('layouts.app')

@section('content')
<h1>Позиции</h1>

<div>
<ul>
@forelse ($positions as $position)
<li>

<table>
<tr>
<td>{{ $position->description }}</td>
<td>{{ $position->order }}</td>
<td>Окончание: {{ $position->ending }}</td>
<td>
{!! Form::open(['route' => ['positions.edit', $position], 'method' => 'get']) !!}
{!! Form::submit('Редактировать', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
</td>
<td>
{!! Form::open(['route' => ['positions.destroy', $position], 'method' => 'delete']) !!}
{!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
</td>
</tr>
</table>

</li>
@empty
<li>Nothing found!</li>
@endforelse
</ul>
</div>

<div>
{!! Form::open(['route' => ['positions.create'], 'method' => 'get']) !!}
{!! Form::submit('Создать', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
</div>

@endsection