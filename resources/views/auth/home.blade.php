@extends('layouts.app')

@section('title', 'Home')

@section('extra-css')

@endsection

@section('content')
        <h1 style="text-align: center; margin-bottom: 20px">Welcome, {{ $nome }}!</h1>
        <h2 style="text-align: center; margin-bottom: 30px">Elenco degli utenti:</h2>
        <table class="table table-striped mt-5">
            @foreach($users as $index=> $user)
            <tr>
                <td style="color: {{$user->id == Auth::id() ? 'aqua' : '#1a1a1a'}}">{{ $user->userMeta->cognome }} {{ $user->userMeta->nome }}</a></td>
                <td style="color: {{$user->id == Auth::id() ? 'aqua' : '#1a1a1a'}}">{{ $user->email }}</td>
                    <div >
                <td style="color: {{$user->id == Auth::id() ? 'aqua' : '#1a1a1a'}}">{{ $user->userMeta->cellulare }}</td>
                <td><a href="{{ route('user.profile', $user->id) }}" style="color: {{$user->id == Auth::id() ? 'aqua' : '#1a1a1a'}}"><i class="fa-regular fa-user"></i></a></td>
            </tr>
            @endforeach
        </table>
@endsection
    


