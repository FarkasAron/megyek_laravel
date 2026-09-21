@extends('layout')

@section('content')
<div class="list-item" style="margin-bottom: 1.5em;">
    <span class="info">
        @if ($county->badge_url)
            <img src="{{ $county->badge_url }}" alt="{{ $county->name }} címere" class="badge-icon" style="width: 3em; height: 3em;">
        @endif
        <span>
            <h1 style="margin-bottom: 0.15em;">{{ $county->name }}</h1>
            <span class="meta">Összlakosság: {{ number_format($county->cities_sum_population ?? 0, 0, ',', ' ') }} fő</span>
        </span>
    </span>
    <span class="actions">
        <a href="{{ route('counties.edit', $county->id) }}" class="button">Szerkesztés</a>
        <a href="{{ route('counties.index') }}" class="button">Vissza</a>
    </span>
</div>

<h2 style="margin-bottom: 0.75em;">Városok</h2>
<ul>
    @foreach ($cities as $city)
    <li class="list-item">
        <span class="info">
            <span class="name">{{ $city->name }}</span>
            <span class="meta">{{ number_format($city->population, 0, ',', ' ') }} fő</span>
        </span>
        <span class="actions">
            <a href="{{ route('cities.show', $city->id) }}" class="button">Megjelenítés</a>
        </span>
    </li>
    @endforeach
</ul>
{{ $cities->links('pagination.custom') }}
@endsection
