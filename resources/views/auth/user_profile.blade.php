@extends('layouts.guest')

@section('title', 'Utente')

@section('extra-css')
<link href="{{ asset('css/user_profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="fail-message">
                {{ $error }}
            </div>
        @endforeach
    @endif
        <h2>Profilo di {{ $nome }} {{ $cognome }}</h2>
        @if ($errors->any()) 
            @foreach ($errors->all() as $error)
                <div class = "fail-message">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        <ul>
            <li>Nome: <span class= "info">{{ $nome }}</span></li>
            <li>Cognome: <span class= "info">{{ $cognome }}</span></li>
            <li>Indirizzo: <span class= "info">{{ $indirizzo }}</span></li>
            <li>CAP: <span class= "info">{{ $cap }}</span></li>
            <li>Città: <span class= "info">{{ $citta }}</span></li>
            <li>Provincia: <span class= "info">{{ $provincia }}</span></li>
            <li>Nazione: <span class= "info">{{ $nazione }}</span></li>
        </ul>
        @if ($isAdmin)
            <h2>Vuoi aggiornare o eliminare i dati di {{ $nome }} {{ $cognome }}?</h2>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <ul>
                    <li>Nome: <input type="text" name="nome" value="{{ $nome }}" required></li>
                    <li>Cognome: <input type="text" name="cognome" value="{{ $cognome }}" required></li>
                    <li>Indirizzo: <input type="text" name="indirizzo" value="{{ $indirizzo }}"></li>
                    <li>CAP: <input type="text" name="cap" value="{{ $cap }}"></li>
                    <li>Città: <input type="text" name="citta" value="{{ $citta }}"></li>
                    <li>Provincia: <input type="text" name="provincia" value="{{ $provincia }}"></li>
                    <li>Nazione: 
                        <select name="nazione_id" required>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $country->id == $nazione_id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select> 
                    </li>
                </ul>
                <button class="bottone_modifica" type="submit">Modifica Profilo</button>
            </form>
            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="margin-top: 20px;">
                @csrf
                @method('DELETE')
                <button class="bottone_elimina" type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo utente?')">Elimina Utente</button>
            </form>
        @endif
@endsection