@extends('layouts.app')

@section('content')

<div class="content">
    <div class="results">
        <div class="typo typo_h1">Вот что нашлось</div>
        @forelse ($accounts as $account)
            <div class="results__list">
                <div class="card">
                    <div class="card__avatar"><img src="{{ '/storage/profile_'.$account->id.'.jpg' }}"/></div>
                    <div class="card__name typo typo_h3">{{ $account->first_name }} {{ $account->middle_name }} {{ $account->lastname }}</div>
                    <div class="card__about typo typo_body">{{ $account->description }}</div>
                    <div class="card__contacts">
                        @forelse ($account->accountRefs as $ref)
                        <a href="{{ $ref->reference }}" class="button button_icon typo">XX</a>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
            <div class="typo typo_h2">Пустота.</div>
        @endforelse
        <div class="results__nav typo typo_h3">
            {{ $accounts->links() }}
        </div>
    </div>
</div>


{{ $accounts->links() }}

@endsection
