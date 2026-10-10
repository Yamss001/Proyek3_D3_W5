<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <p>Masuk untuk membuka dashboard</p>

    {{-- Pesan error: validasi kosong atau login gagal --}}
    @if ($errors->any())
        <div role="alert">
            @foreach ($errors->all() as $error)
                <p>[ {{ $error }} ]</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <p>
            <label for="username">Username</label><br>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                autocomplete="username"
                {{ old('username') ? '' : 'autofocus' }}
            >
        </p>

        <p>
            <label for="password">Password</label><br>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                {{ old('username') ? 'autofocus' : '' }}
            >
        </p>

        <button type="submit">Masuk</button>
    </form>
</body>
</html>