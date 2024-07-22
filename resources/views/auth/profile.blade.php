<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di {{ $nome }} {{ $cognome }}</title>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
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
        <h1>Vuoi aggiornare i tuoi dati?</h1>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <ul>
                <li>Nome: <input type="text" name="nome" value="{{ $nome }}"></li>
                <li>Cognome: <input type="text" name="cognome" value="{{ $cognome }}"></li>
                <li>Indirizzo: <input type="text" name="indirizzo" value="{{ $indirizzo }}"></li>
                <li>CAP: <input type="text" name="cap" value="{{ $cap }}"></li>
                <li>Città: <input type="text" name="citta" value="{{ $citta }}"></li>
                <li>Provincia: <input type="text" name="provincia" value="{{ $provincia }}"></li>
                <li>Nazione: 
                    <select name="nazione_id">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ $country->id == $nazione_id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </li>
            </ul>
            <button type="submit">Aggiorna Profilo</button>
        </form>
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </main>
</body>
</html>




        
    
