@extends('layouts.app')

@section('content')

<div class="content">
    <div class="about">
        
		<div class="typo typo_h2"> {{ $item ? $item->description : null }} </div>
        <div class="typo typo_body">Делается в <b>DADA Agency</b></div>
    </div>
</div>

@endsection
