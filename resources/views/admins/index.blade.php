@extends('layouts.app')

@section('content')

<div class="content">
    <div class="auth">

        <div class="auth__type typo typo_h1">
            <a href="{{ route('events.index') }}">События</a>
        </div>

        <div class="auth__type typo typo_h1">
            <a href="{{ route('positions.index') }}">Позиции</a>
        </div>
		
    </div>
</div>

@endsection
