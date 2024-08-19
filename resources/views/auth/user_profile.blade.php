@extends('layouts.app')

@section('title', 'Utente')

@section('extra-css')

@endsection

@section('content')
<div id="app">
    <profile :user="{{ json_encode($user) }}"
        :nome="{{ json_encode($nome) }}"
        :cognome="{{ json_encode($cognome) }}"
        :indirizzo="{{ json_encode($indirizzo) }}"
        :cap="{{ json_encode($cap) }}"
        :citta="{{ json_encode($citta) }}"
        :provincia="{{ json_encode($provincia) }}"
        :nazione_id="{{ json_encode($nazione_id) }}"
        :cellulare="{{ json_encode($cellulare) }}"
        :email="{{ json_encode($email) }}"
        :is-admin="{{ json_encode($isAdmin) }}"
        :is-my-profile="{{ json_encode($isMyProfile) }}"
        :countries="{{ json_encode($countries) }}">
    </profile>

</div>
@endsection