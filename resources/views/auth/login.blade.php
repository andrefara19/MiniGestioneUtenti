@extends('layouts.app')

@section('title', 'Login')

@section('extra-css')

@endsection

@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="fail-message">
    {{ $error }}
</div>
@endforeach
@endif
<div class="row">
    <div class="col-sm-12 col-md-4"> </div>
    <div class="col-sm-12 col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Password" required minlength="8">
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4"> </div>
</div>
@endsection