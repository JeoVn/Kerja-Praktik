<!-- resources/views/auth/register-first-owner.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Owner Pertama</title>
</head>
<body>
    <h2>Registrasi Owner Pertama</h2>

    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('register.first-owner') }}">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br>
        @error('name') <div>{{ $message }}</div> @enderror

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br>
        @error('email') <div>{{ $message }}</div> @enderror

        <label>Password:</label><br>
        <input type="password" name="password"><br>
        @error('password') <div>{{ $message }}</div> @enderror

        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation"><br>

        <button type="submit">Daftar Owner</button>
    </form>
</body>
</html>
