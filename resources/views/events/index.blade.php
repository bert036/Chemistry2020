@extends('layouts.app')

@section('content')
<h1>События</h1>

<div>
<ul>
@forelse ($events as $event)
<li>

<table>
<tr>
<td>{{ $event->description }}</td>
<td>{{ $event->start_date }}</td>
<td>{{ $event->end_date }}</td>
<td>{{ $event->is_active }}</td>
<td>
{!! Form::open(['route' => ['events.edit', $event], 'method' => 'get']) !!}
{!! Form::submit('Редактировать', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
</td>
<td>
{!! Form::open(['route' => ['events.destroy', $event], 'method' => 'delete']) !!}
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
{!! Form::open(['route' => ['events.create'], 'method' => 'get']) !!}
{!! Form::submit('Создать', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
</div>

@endsection