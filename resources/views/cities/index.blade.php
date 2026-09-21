@extends ('layout')

@section('content')
<h1>Városok</h1>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('cities.index') }}" method="GET" class="filter-bar">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Keresés város neve alapján...">

    <select name="county">
        <option value="">Összes megye</option>
        @foreach ($counties as $county)
        <option value="{{ $county->id }}" @selected(request('county') == $county->id)>{{ $county->name }}</option>
        @endforeach
    </select>

    <button type="submit">Szűrés</button>
    @if (request()->hasAny(['search', 'county']))
        <a href="{{ route('cities.index') }}">Szűrés törlése</a>
    @endif
</form>

<ul>
    @foreach ($cities as $city)
    <li class="list-item">
        <span class="info">
            <span class="name">{{ $city->name }}</span>
            <span class="meta">{{ $city->county->name }} · {{ number_format($city->population, 0, ',', ' ') }} fő</span>
        </span>
        <span class="actions">
            <a href="{{ route('cities.show', $city->id) }}" class="button">Megjelenítés</a>
            <a href="{{ route('cities.edit', $city->id) }}" class="button">Szerkesztés</a>
            <form action="{{ route('cities.destroy', $city->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Tutira törlöd?')">Törlés</button>
            </form>
        </span>
    </li>
    @endforeach
</ul>

{{ $cities->links('pagination.custom') }}
@endsection
