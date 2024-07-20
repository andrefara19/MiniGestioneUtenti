<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
        <input type="password" name="password" placeholder="Password" required minlength="8">
        <button type="submit">Login</button>
    </form>
</body>
</html>

</html>