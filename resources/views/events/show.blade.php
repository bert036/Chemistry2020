@extends('layouts.app')

@section('content')

<h1>Событие {{ $event->id }}</h1>

<p>
Описание: {{ $event->description }} <br/>
Начало: {{ $event->start_date }} <br/>
окончание: {{ $event->end_date }} <br/>
</p>

@endsection