@extends ('layout')

@section('content')
<h1>Megyék</h1>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-warning">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('counties.index') }}" method="GET">
    <fieldset>
        <label for="search">Keresés</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Megye neve">
        <button type="submit">Keresés</button>
        <a href="{{ route('counties.index') }}">Keresés törlése</a>
    </fieldset>
</form>

<ul>
    @foreach ($counties as $county)
    <li>
        @if ($county->badge)
            <img src="{{ $county->badge }}" alt="{{ $county->name }} címere" width="32" height="32">
        @endif
        {{ $county->name }} — összlakosság: {{ number_format($county->cities_sum_population ?? 0, 0, ',', ' ') }} fő
        <a href="{{ route('counties.show', $county->id) }}" class="button">Megjelenítés</a>
        <a href="{{ route('counties.edit', $county->id) }}" class="button">Szerkesztés</a>
        <form action="{{ route('counties.destroy', $county->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Tutira törlöd?')">Törlés</button>
        </form>
    </li>
    @endforeach
</ul>
@endsection
