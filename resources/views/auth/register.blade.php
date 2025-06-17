@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <style>
        .home-link {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
        }

        .home-link:hover {
            text-decoration: underline;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid">

    <!-- Header dengan tombol kembali -->
    <div class="page-header">
        <a href="{{ route('owner.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 home-link">
            <i class="fas fa-home"></i> Kembali ke Home
        </a>

     
    </div>
    
    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <!-- Registration Form Card -->
                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                        <h2>Form Registrasi</h2>
                    </div>

                    <!-- Success/Error Messages -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}" class="card-body p-4">
                        @csrf

                        <!-- Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Confirmation Input -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <!-- Role Selection -->
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

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Daftar</button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-3">
                            <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-link">Login di sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
