<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Nama:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br>
        @error('name') <div style="color:red;">{{ $message }}</div> @enderror

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br>
        @error('email') <div style="color:red;">{{ $message }}</div> @enderror

        <label>Password:</label><br>
        <input type="password" name="password"><br>
        @error('password') <div style="color:red;">{{ $message }}</div> @enderror

        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation"><br>

        <label>Role:</label><br>
        <select name="role">
            <option value="">-- Pilih Role --</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
        </select><br>
        @error('role') <div style="color:red;">{{ $message }}</div> @enderror

        <br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
