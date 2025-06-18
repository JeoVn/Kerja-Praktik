@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/forgot-pass.css') }}">

     
    @endpush
@section('content')
<div class="forgot-wrapper">
    <div class="forgot-card">
        <h2>Lupa Password</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
    </form>
</div>
</div>
@endsection
