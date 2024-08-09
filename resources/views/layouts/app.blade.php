<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    @yield('extra-css')
</head>

<body class="body">
    <header class="header">
        <span class="logo">Mini Gestione Utenti</span>
        <input id="menu-button" class="menu-button" type="checkbox">
        <label for="menu-button" class="menu-label">
            <span class="menu-icon"></span>
        </label>
        <ul class="menu">
            <li><a href="{{ url('/registrati/') }}">REGISTRATI</a></li>
            <li><a href="{{ url('/login/') }}">LOGIN</a></li>
        </ul>
    </header>

    <main class="main">
        @yield('content')
    </main>

    @yield('extra-scripts')
</body>

</html>