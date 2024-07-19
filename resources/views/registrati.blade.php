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
                <legend>Dati anagrafici e di contatto</legend>
                <br>
                <label for="nome"><span class="asterisk">*</span> Nome</label>
                <input type="text" name="nome" required>
                <br><br>
                <label for="cognome"><span class="asterisk">*</span> Cognome</label>
                <input type="text" name="cognome" required>
                <br><br>
                <label for="indirizzo">Indirizzo</label>
                <input type="text" name="indirizzo">
                <br><br>
                <label for="CAP">CAP</label>
                <input type="text" name="CAP">
                <br><br>
                <label for="citta">Città</label>
                <input type="text" name="citta">
                <br><br>
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia">
                <br><br>
                <label for="nazione"> <span class="asterisk">*</span> Nazione</label>
                <select name="nazione" required>
                    <option value="">Seleziona</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                </select>
                <br><br>
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