@extends('layouts.app')

@section('content')

<div class="content">
	<div class="search typo typo_h1">

		{!! Form::open(['route' => 'welcome.step036'], ['class' => 'form']) !!}

            <div class="settings__about typo typo_h3">
                {!! Form::password('password', null,['class' => 'form-control input-lg', 'cols' => '', 'rows' => '1']) !!}
            </div>

		{!! Form::submit() !!}

		{!! Form::close() !!}

	</div>
</div>

@endsection
