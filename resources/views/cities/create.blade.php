@extends ('layout')

@section('content')
<h1>Új Város</h1>

<form action="{{ route('cities.store') }}" method="POST">
    @csrf
    <fieldset>
        <label for="name">Város név</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    </fieldset>
    <fieldset>
        <label for="id_county">Megye</label>
        <select name="id_county" id="id_county">
            @foreach ($counties as $county)
            <option value="{{ $county->id }}" @selected(old('id_county') == $county->id)>{{ $county->name }}</option>
            @endforeach
        </select>
        @error('id_county')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    </fieldset>
    <fieldset>
        <label for="zip_code">Irányítószám</label>
        <input type="number" name="zip_code" id="zip_code" value="{{ old('zip_code') }}">
        @error('zip_code')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    </fieldset>
    <fieldset>
        <label for="population">Lakosság</label>
        <input type="number" name="population" id="population" min="0" value="{{ old('population') }}">
        @error('population')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    </fieldset>
    <button type="submit">Ment</button>
</form>
@endsection
