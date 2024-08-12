@extends('layouts.guest')

@section('title', 'Home')

@section('extra-css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
        <h1>Welcome, {{ $nome }}!</h1>
        <h2>Elenco degli utenti:</h2>
        <table style="border-collapse: collapse;">
            @foreach($users as $index=> $user)
            <tr>
                <td><a href="{{ route('user.profile', $user->id) }}" style="color: {{$user->id == Auth::id() ? 'aqua' : 'silver'}}">
                            {{ $user->userMeta->nome }} {{ $user->userMeta->cognome }}</a></td>
                <td style="color: {{$user->id == Auth::id() ? 'aqua' : 'silver'}}">{{ $user->email }}</td>
                    <div >
            </tr>
            @endforeach
@endsection
    


