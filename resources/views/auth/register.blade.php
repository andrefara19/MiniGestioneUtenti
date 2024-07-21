<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <script>
        function validatePassword() {
            var password = document.getElementById("password");
            var confirm_password = document.getElementById("confirmPassword");
            if (password.value !== confirm_password.value) {
                confirm_password.setCustomValidity("Le password non coincidono");
            } else {
                confirm_password.setCustomValidity('');
            }
        }
    </script>
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
        <div class="register_form_container">
        <form class="register_form" action="{{ route('register') }}" method="POST">
            @csrf
            <span class="asterisk">*</span> <input type="text" name="nome" placeholder="Nome" required>
            <br><br>
            <span class="asterisk">*</span> <input type="text" name="cognome" placeholder="Cognome" required>
            <br><br>
            <input class="no_asterisk" type="text" name="indirizzo" placeholder="Indirizzo">
            <br><br>
            <input class="no_asterisk" type="text" name="cap" placeholder="CAP">
            <br><br>
            <input class="no_asterisk" type="text" name="citta" placeholder="Città">
            <br><br>
            <input class="no_asterisk" type="text" name="provincia" placeholder="Provincia">
            <br><br>
            <span class="asterisk">*</span><select class="nazione" name="nazione_id" required>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            <br><br>
            <span class="asterisk">*</span> <input type="email" name="email" placeholder="Email" required>
            <br><br>
            <span class="asterisk">*</span> <input id="password" type="password" name="password" placeholder="Password" required minlength="8">
            <br><br>
            <span class="asterisk">*</span> <input id="confirmPassword" type="password" name="password_confirmation" placeholder="Conferma Password" required oninput="validatePassword()">
            <br><br>
            <button class= "register_button" type="submit">Registrati</button>
            <input type="reset" class="reset_button" value="Resetta">
            <br><br>
            <p><span class="asterisk">*</span><span class="campi_obbligatori">Campi obbligatori</span> 
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
        </div>    
        @endif
    </main>
</body>

</html>

