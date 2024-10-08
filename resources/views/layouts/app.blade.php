<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('extra-css')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16/dist/vue.js"></script>
</head>

<body class="body" style="background-color: #1A3A5F; color: #D1D1D1">
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
        <div class="container-fluid">
            <a class="navbar-brand">MiniGestioneUtenti</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/registrati/') }}">Registrati</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login/') }}">Login</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest

                    @php
                        $routes_utenti_eventi = ['profile.index', 'user.profile', 'event.edit', 'event.create', 'subscriptions.create'];
                        $routes_eventi = ['home'];
                        $routes_utenti = ['event.index', 'event.index.user'];
                    @endphp
                    @if (in_array(request()->route()->getName(), $routes_utenti_eventi))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/area_personale/') }}">Lista utenti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/eventi/') }}">Lista eventi</a>
                    </li>
                    @endif
                    @if (in_array(request()->route()->getName(), $routes_eventi))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/eventi/') }}">Lista eventi</a>
                    </li>
                    @endif
                    @if (in_array(request()->route()->getName(), $routes_utenti))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/area_personale/') }}">Lista utenti</a>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @yield('extra-scripts')
</body>

</html>