@extends('layout')

@section('content')
<h1>"{{ $county->name }}" szerkesztése</h1>

<form action="{{ route('counties.update', $county->id) }}" method="POST">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="name">Megye név</label>
        <input type="text" name="name" id="name" value="{{ old('name', $county->name) }}">
        @error('name')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    </fieldset>
    <fieldset>
        <label for="badge">Címer (kép URL)</label>
        <input type="text" name="badge" id="badge" value="{{ old('badge', $county->badge) }}" placeholder="https://...">
        @error('badge')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    </fieldset>
    <button type="submit">Ment</button>
</form>
@endsection
