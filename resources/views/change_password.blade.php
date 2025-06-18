@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/change-pass.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backhome.css') }}">
     
    @endpush

@section('content')

<div class="container-fluid">
<div class="page-header">
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('admin.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 home-link">
            <i class="fas fa-home"></i> Kembali ke Home
            </a>
        @elseif(auth()->user()->role == 'owner')
            <a href="{{ route('owner.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 home-link">
            <i class="fas fa-home"></i> Kembali ke Home
            </a>
        @endif
        
</div>
 <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <!-- Registration Form Card -->
                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                        <h2>Ganti Kata Sandi</h2>
                    </div>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="mb-3">
            <label>Password Saat Ini</label>
            <input type="password" name="current_password" class="form-control" required>
            @error('current_password')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="new_password" class="form-control" required>
            @error('new_password')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ubah Password</button>
    </form>
</div>
@endsection
