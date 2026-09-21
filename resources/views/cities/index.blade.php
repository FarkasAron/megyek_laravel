@extends ('layout')

@section('content')
<h1>Városok</h1>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('cities.index') }}" method="GET">
    <fieldset>
        <label for="search">Keresés</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Város neve">

        <label for="county">Megye</label>
        <select name="county" id="county">
            <option value="">Összes megye</option>
            @foreach ($counties as $county)
            <option value="{{ $county->id }}" @selected(request('county') == $county->id)>{{ $county->name }}</option>
            @endforeach
        </select>

        <button type="submit">Szűrés</button>
        <a href="{{ route('cities.index') }}">Szűrés törlése</a>
    </fieldset>
</form>

<ul>
    @foreach ($cities as $city)
    <li>
        {{ $city->name }} ({{ $city->county->name }}, {{ number_format($city->population, 0, ',', ' ') }} fő)
        <a href="{{ route('cities.show', $city->id) }}" class="button">Megjelenítés</a>
        <a href="{{ route('cities.edit', $city->id) }}" class="button">Szerkesztés</a>
        <form action="{{ route('cities.destroy', $city->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Tutira törlöd?')">Törlés</button>
        </form>
    </li>
    @endforeach
</ul>

{{ $cities->links() }}
@endsection
