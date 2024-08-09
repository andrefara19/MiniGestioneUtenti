@extends('layouts.guest')

@section('title', 'Registrati')

@section('extra-css')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="fail-message">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <form class="register_form" action="{{ route('register') }}" method="POST">
        @csrf
        <span class="asterisk">*</span> <input type="text" name="nome" placeholder="Nome" required>
        <br><br>
        <span class="asterisk">*</span> <input type="text" name="cognome" placeholder="Cognome" required>
        <br><br>
        <input class="no_asterisk" type="text" name="indirizzo" placeholder="Indirizzo">
        <br><br>
        <input class="no_asterisk" type="text" name="cap" placeholder="CAP">
        <br><br>
        <input class="no_asterisk" type="text" name="citta" placeholder="Città">
        <br><br>
        <input class="no_asterisk" type="text" name="provincia" placeholder="Provincia">
        <br><br>
        <span class="asterisk">*</span><select class="nazione" name="nazione_id" required>
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
        <br><br>
        <span class="asterisk">*</span> <input type="email" name="email" placeholder="Email" required>
        <br><br>
        <span class="asterisk">*</span> <input id="password" type="password" name="password" placeholder="Password" required minlength="8" oninput="validatePassword()">
        <br><br>
        <span class="asterisk">*</span> <input id="confirmPassword" type="password" name="password_confirmation" placeholder="Conferma Password" required oninput="validatePassword()">
        <br><br>
        <div id="form-buttons">
            <button class="register_button" type="submit">Registrati</button>
            <input type="reset" class="reset_button" value="Resetta">
        </div>
        <br><br>
        <div class="campi_obbligatori">        
            <p><span class="asterisk">*</span><span>  Campi obbligatori</span></p>
        </div>
    </form>
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
        if ({{ session('success') ? 'true' : 'false' }}) {
            var buttonsDiv = document.getElementById('form-buttons');
            buttonsDiv.innerHTML = '<div class="success-message">{{ session('success') }}</div>';
        }
    });
</script>
@endsection