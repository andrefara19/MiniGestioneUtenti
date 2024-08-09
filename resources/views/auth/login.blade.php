@extends('layouts.guest')

@section('title', 'Login')

@section('extra-css')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class = "fail-message">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <form class="login_form" action="{{ route('login') }}" method="POST">
            @csrf
            <input class="campo_email" type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
            <br><br>
            <input class="campo_password" type="password" name="password" placeholder="Password" required minlength="8">
            <br><br>
            <button class="login_button" type="submit">Login</button>
        </form>
@endsection
