<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- <link href="{{ asset('css/header.css') }}" rel="stylesheet"> -->
    @yield('extra-css')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</head>

<body class="body">
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
        <div class="container-fluid">
            <a class="navbar-brand">MiniGestioneUtenti</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/registrati/') }}">Registrati</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login/') }}">Login</a>
                    </li>
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