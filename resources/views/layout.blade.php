<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megyék program</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <header></header>
    <nav>
        <ul>
            <li><a href="{{ route('cities.index') }}">Városok</a></li>
            <li><a href="{{route('counties.index')}}">Megyék</a></li>
            <li><a href="{{route('cities.create')}}">Új város</a></li>
            <li><a href="{{route('counties.create')}}">Új megye </a></li>
            @auth
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Kijelentkezés ({{ auth()->user()->name }})</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Bejelentkezés</a></li>
            @endauth
        </ul>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer></footer>
    
</body>
</html>