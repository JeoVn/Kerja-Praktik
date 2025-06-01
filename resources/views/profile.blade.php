
@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    .profile-header {
        background: linear-gradient(135deg, #6b8dd6, #8e37d7);
        color: white;
        padding: 30px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        text-align: center;
        box-shadow: 0 4px 12px rgb(110 89 184 / 0.4);
    }
    .profile-info p {
        font-size: 1.1rem;
    }
    .admin-list {
        margin-top: 20px;
    }
    .admin-list .card {
        box-shadow: 0 0 15px rgb(0 0 0 / 0.05);
        border-radius: 12px;
        transition: transform 0.2s ease;
    }
    .admin-list .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgb(0 0 0 / 0.15);
    }
    .btn-danger:hover {
        background-color: #b22222;
    }
</style>
@endpush

@section('content')
<div class="container my-4">
    <div class="profile-header">
        <h2>Profil Saya</h2>
        <!-- <p class="mb-0">Selamat datang, <strong>{{ $user->name }}</strong>!</p> -->
    </div>

    <div class="profile-info bg-white p-4 rounded shadow-sm">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> <span class="text-capitalize">{{ $user->role }}</span></p>

        <a href="{{ route('password.change') }}" class="btn btn-primary mt-3">Ganti Kata Sandi</a>
    </div>

    @if($user->role === 'owner')
    <div class="admin-list">
        <h4 class="mt-5 mb-4">Daftar Admin Terdaftar</h4>
        @if($admins->isEmpty())
            <div class="alert alert-info">Belum ada admin terdaftar.</div>
        @else
            <div class="row gy-4">
                @foreach($admins as $admin)
                    <div class="col-md-4">
                        <div class="card p-3">
                            <h5>{{ $admin->name }}</h5>
                            <p><strong>Email:</strong> {{ $admin->email }}</p>
                            <p><strong>Role:</strong> {{ ucfirst($admin->role) }}</p>

                            <form action="{{ route('admin.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus admin ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mt-2 w-100">Hapus Admin</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    @endif
</div>
@endsection