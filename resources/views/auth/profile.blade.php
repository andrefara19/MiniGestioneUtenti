<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di {{ $nome }} {{ $cognome }}</title>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
</head>
<body>
    <header class="header">
        <span class="logo">Mini Gestione Utenti</span>
        <input id="menu-button" class="menu-button" type="checkbox">
        <label for="menu-button" class="menu-label">
            <span class="menu-icon"></span>
        </label>
        <ul class="menu">
            @guest
                <li><a href="{{ url('/registrati/') }}">REGISTRATI</a></li>
                <li><a href="{{ url('/login/') }}">LOGIN</a></li>
            @else
                <li><a href="{{ url('/area_personale/') }}">HOME</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
    </header>
    <main class="main">
        <h1>Il tuo profilo</h1>
        <ul>
            <li>Nome: {{ $nome }}</li>
            <li>Cognome: {{ $cognome }}</li>
            <li>Indirizzo: {{ $indirizzo }}</li>
            <li>CAP: {{ $cap }}</li>
            <li>Città: {{ $citta }}</li>
            <li>Provincia: {{ $provincia }}</li>
            <li>Nazione: {{ $nazione }}</li>
        </ul>
    </main>
</body>
</html>
