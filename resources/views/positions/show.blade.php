@extends('layouts.app')

@section('content')

<h1> Позиция {{ $position->id }}</h1>

<p>
Описание: {{ $position->description }} <br />
Вес: {{ $position->order }}
</p>

@endsection