@extends('layouts.app')

@section('title', 'Registrati')

@section('extra-css')

@endsection

@section('content')
<div id="app">
    <register />
</div>
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
            <div class="card-header">
                <h4>Registrati</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nome" placeholder="Nome *" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="cognome" placeholder="Cognome *" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="indirizzo" placeholder="Indirizzo">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="cap" placeholder="CAP">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="citta" placeholder="Città">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="provincia" placeholder="Provincia">
                    </div>
                    <select class="form-select mb-3" name="nazione_id" required>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <div class="mb-3">
                        <input class="form-control" type="tel" name="cellulare" placeholder="Cellulare *" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email" placeholder="Email *" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" id= "password" type="password" name="password" placeholder="Password *" minlength="8" required oninput="validatePassword()">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" id= "confirmPassword" type="password" name="password_confirmation" placeholder="Conferma password *" required oninput="validatePassword()">
                    </div>
                    <button class="btn btn-primary mt-3" style="margin-right: 10px;" type="submit">Registrati</button>
                    <button class="btn btn-secondary mt-3" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4"> </div>
</div>
@endsection


@section('extra-scripts')
<script>
    function validatePassword() {
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirmPassword");
        if (password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Le password non coincidono");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if ({
                {
                    session('success') ? 'true' : 'false'
                }
            }) {
            var buttonsDiv = document.getElementById('form-buttons');
            buttonsDiv.innerHTML = '<div class="success-message">{{ session('
            success ') }}</div>';
        }
    });
</script>
@endsection

