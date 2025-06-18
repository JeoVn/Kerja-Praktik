@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reset Password</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- CEK JIKA MASIH LOGIN --}}
    @if (Auth::check())
        <div class="alert alert-danger">⚠️ Kamu masih login sebagai {{ Auth::user()->email }}</div>
    @endif

    <form method="POST" action="{{ route('password.reset.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection
