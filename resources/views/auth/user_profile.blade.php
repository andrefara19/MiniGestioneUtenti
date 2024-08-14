@extends('layouts.app')

@section('title', 'Utente')

@section('extra-css')

@endsection

@section('content')
<h2 style="text-align: center; margin-bottom:30px;">{{ $isMyProfile ? 'Il tuo profilo, ' . $nome : 'Profilo di ' . $nome . ' ' . $cognome }}</h2>
@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {{ $error }}
</div>
@endforeach
@endif
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<div class="row">
    <div class="col-sm-12 col-md-4"> </div>
    <div class="col-sm-12 col-md-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nome" value="{{ $nome }}" placeholder="Nome" required {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="cognome" value="{{ $cognome }}" placeholder="Cognome" required {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="indirizzo" value="{{ $indirizzo }}" placeholder="Indirizzo" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="cap" value="{{ $cap }}" placeholder="Cap" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="citta" value="{{ $citta }}" placeholder="Città" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="provincia" value="{{ $provincia }}" placeholder="Provincia" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                    </div>
                    <select class="form-select mb-3" name="nazione_id" required {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ $country->id == $nazione_id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <div class="mb-3">
                        <input class="form-control" type="tel" name="cellulare" value="{{ $cellulare }}" placeholder="Cellulare" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email" value="{{ $email }}" placeholder="Email" {{!$isAdmin && !$isMyProfile ? 'disabled' : ''}}>
                    </div>
                    @if($isAdmin || $isMyProfile)
                    <button class="btn btn-success mb-3 mt-4" type="submit">Modifica profilo</button>
                    @endif
                </form>
                @if($isAdmin && !$isMyProfile)
                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo utente?')">Elimina utente</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4"> </div>
</div>
@endsection