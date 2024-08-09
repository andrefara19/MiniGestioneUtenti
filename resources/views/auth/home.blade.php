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
                <li>
                    <a href="{{ route('user.profile', $user->id) }}" style="color: {{$user->id == Auth::id() ? 'aqua' : 'silver'}}" >    
                        {{ $user->userMeta->nome }} {{ $user->userMeta->cognome }} </a>
                </li>
            @endforeach
        </ul>
@endsectionaaaa
    


