<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
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
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="login_form" action="{{ route('login') }}" method="POST">
            @csrf
            <input class="campo_email" type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
            <br><br>
            <input class="campo_password" type="password" name="password" placeholder="Password" required minlength="8">
            <br><br>
            <button class="login_button" type="submit">Login</button>
        </form>
    </main>
</body>
</html>

</html>