<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
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
        <form>
            <fieldset>
                <label for="email"><span class="asterisk">*</span>E-mail</label>
                <input type="email" name="email" required>
                <br><br>
                <label for="password"><span class="asterisk">*</span> Password</label>
                <input type="password" required>
            </fieldset>
            <br><br>
            <p><span class="asterisk">*</span> Campi obbligatori</p>
            <input type="submit" value="Invia">
            <input type="reset" value="Resetta">
        </form>
        <br>
    </main>
</body>

</html>