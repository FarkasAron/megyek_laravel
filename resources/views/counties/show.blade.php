@extends('layout')

@section('content')
<h1>"{{ $county->name }}" részletek</h1>

@if ($county->badge)
    <img src="{{ $county->badge }}" alt="{{ $county->name }} címere" width="96" height="96">
@endif

<ul>
    <li>Összlakosság: {{ number_format($county->cities_sum_population ?? 0, 0, ',', ' ') }} fő</li>
</ul>

<h2>Városok</h2>
<ul>
    @foreach ($cities as $city)
    <li>
        {{ $city->name }} ({{ number_format($city->population, 0, ',', ' ') }} fő)
        <a href="{{ route('cities.show', $city->id) }}" class="button">Megjelenítés</a>
    </li>
    @endforeach
</ul>
{{ $cities->links() }}

<a href="{{ route('counties.edit', $county->id) }}" class="button">Szerkesztés</a>
<a href="{{ route('counties.index') }}" class="button">Vissza</a>
@endsection
