<!DOCTYPE html>
<html>
<head>
    <title>Home - {{ $nome }} {{ $cognome }}</title>
</head>
<body>
    <h1>Benvenuto nella tua area personale, {{ $nome }} {{ $cognome }}</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
