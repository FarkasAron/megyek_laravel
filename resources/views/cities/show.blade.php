@extends('layout')

@section('content')
<h1>"{{ $city->name }}" részletek</h1>

<ul>
    <li>Megye: {{ $city->county->name }}</li>
    <li>Irányítószám: {{ $city->zip_code }}</li>
    <li>Lakosság: {{ number_format($city->population, 0, ',', ' ') }} fő</li>
</ul>

<a href="{{ route('cities.edit', $city->id) }}" class="button">Szerkesztés</a>
<a href="{{ route('cities.index') }}" class="button">Vissza</a>
@endsection
