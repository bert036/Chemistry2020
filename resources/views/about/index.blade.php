@extends('layouts.app')

@section('content')

<div class="content">
    <div class="about">
        
		<div class="typo typo_h2"> {{ $description ? $description->content : null }} </div>
        <div class="typo typo_body">Делается в <b>DADA Agency</b></div>
		
		@forelse ($refs as $ref)
			<a href = "{{ $ref->content }}" title = "{{ $ref->content }}">{{ $ref->additional }}</a>
			<br/>
		@empty
		@endforelse
    </div>
</div>

@endsection
