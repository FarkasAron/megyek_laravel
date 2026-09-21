@extends ('layout')

@section('content')
<h1>Új Megye</h1>

<form action="{{ route('counties.store') }}" method="POST">
    @csrf
    <fieldset>
        <label for="name">Megye név</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    </fieldset>
    <fieldset>
        <label for="badge">Címer (kép URL)</label>
        <input type="text" name="badge" id="badge" value="{{ old('badge') }}" placeholder="https://...">
        @error('badge')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    </fieldset>
    <button type="submit">Ment</button>
</form>
@endsection
