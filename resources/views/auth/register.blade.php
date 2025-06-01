<!-- <!DOCTYPE html>
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
</html> -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Registrasi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select class="form-select" id="role" name="role" required>
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
            @error('role')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
@endsection
