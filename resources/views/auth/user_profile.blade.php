@extends('layouts.logged')

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
        <h2>{{ $isMyProfile ? 'Il tuo profilo, ' . $nome : 'Profilo di ' . $nome . ' ' . $cognome }}</h2>
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
        
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <ul>
                    <li>Nome: <input type="text" name="nome" value="{{ $nome }}" required {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} ></li>
                    <li>Cognome: <input type="text" name="cognome" value="{{ $cognome }}" required {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} ></li>
                    <li>Indirizzo: <input type="text" name="indirizzo" value="{{ $indirizzo }}" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} ></li>
                    <li>CAP: <input type="text" name="cap" value="{{ $cap }}" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} ></li>
                    <li>Città: <input type="text" name="citta" value="{{ $citta }}" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} ></li>
                    <li>Provincia: <input type="text" name="provincia" value="{{ $provincia }}" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} ></li>
                    <li>Nazione: 
                        <select name="nazione_id" required {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} >
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $country->id == $nazione_id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select> 
                    </li>
                    <li>Cellulare: <input type="tel" name="cellulare" value="{{ $cellulare }}" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} ></li>
                    <li>Email: <input type="email" name="email" value="{{ $email }}" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}} ></li>
                </ul>
                @if($isAdmin || $isMyProfile)
                    <button class="bottone_modifica" type="submit">Modifica Profilo</button>
                @endif   
            </form>
            @if($isAdmin || $isMyProfile)
                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    @method('DELETE')
                    <button class="bottone_elimina" type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo utente?')">Elimina Utente</button>
                </form>
            @endif       
@endsection