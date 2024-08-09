@extends('layouts.guest')

@section('title', 'Home')

@section('extra-css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
        <h1>Welcome, {{ $nome }}!</h1>
        <h2>Elenco degli utenti:</h2>
        <ul class="lista_utenti">
            @foreach($users as $user)
                @if ($user->id !== Auth::id())
                    @if ($user->userMeta)
                        <li>
                            <a href="{{ route('user.profile', $user->id) }}">
                                {{ $user->userMeta->nome }} {{ $user->userMeta->cognome }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="#">
                                Informazioni incomplete per l'utente con email: {{ $user->email }}
                            </a>
                        </li>
                    @endif
                @else
                    @if ($user->userMeta)
                            <li>
                                {{ $user->userMeta->nome }} {{ $user->userMeta->cognome }}
                            </li>
                        @else
                            <li>
                                Informazioni incomplete per l'utente con email: {{ $user->email }}
                            </li>
                        @endif
                    @endif
            @endforeach
        </ul>
@endsection
    


