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

<form action="{{ route('counties.index') }}" method="GET" class="filter-bar">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Keresés megye neve alapján...">
    <button type="submit">Keresés</button>
    @if (request()->filled('search'))
        <a href="{{ route('counties.index') }}">Keresés törlése</a>
    @endif
</form>

<ul>
    @foreach ($counties as $county)
    <li class="list-item">
        <span class="info">
            @if ($county->badge_url)
                <img src="{{ $county->badge_url }}" alt="{{ $county->name }} címere" class="badge-icon">
            @endif
            <span class="name">{{ $county->name }}</span>
            <span class="meta">összlakosság: {{ number_format($county->cities_sum_population ?? 0, 0, ',', ' ') }} fő</span>
        </span>
        <span class="actions">
            <a href="{{ route('counties.show', $county->id) }}" class="button">Megjelenítés</a>
            <a href="{{ route('counties.edit', $county->id) }}" class="button">Szerkesztés</a>
            <form action="{{ route('counties.destroy', $county->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Tutira törlöd?')">Törlés</button>
            </form>
        </span>
    </li>
    @endforeach
</ul>
@endsection
