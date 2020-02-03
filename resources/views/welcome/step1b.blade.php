@extends('layouts.app')

@section('content')

<div class="bar bar_1"></div>

<div class="content">
	<div class="search typo typo_h1">

		{!! Form::open(['route' => 'welcome.step2'], ['class' => 'form']) !!}

            <div class="settings__about typo typo_h3">
                {!! Form::textarea('description', null,['class' => 'form-control input-lg','placeholder' => 'Возможно, вам есть что добавить?', 'cols' => '', 'rows' => '']) !!}
            </div>

		{!! Form::submit() !!}

		{!! Form::close() !!}

	</div>
</div>

@endsection
