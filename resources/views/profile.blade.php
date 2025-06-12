@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    .profile-header {
        background: linear-gradient(135deg, #6b8dd6, rgb(117, 171, 246));
        color: white;
        padding: 30px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(110, 89, 184, 0.4);
    }
    .profile-info p {
        font-size: 1.1rem;
    }
    .admin-list {
        margin-top: 40px;
    }
    .admin-list .card {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        transition: transform 0.2s ease;
    }
    .admin-list .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
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
    </div>

    <div class="profile-info bg-white p-4 rounded shadow-sm">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> <span class="text-capitalize">{{ $user->role }}</span></p>

        <a href="{{ route('password.change') }}" class="btn btn-primary mt-3">
            Ganti Kata Sandi
        </a>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); confirmLogout();"
           class="btn btn-outline-danger mt-2">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
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
                            <p><strong>Status:</strong> 
                                @if($admin->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </p>

                            <form action="{{ route('admin.toggleStatus', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengubah status admin ini?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning btn-sm w-100">
                                    {{ $admin->is_active ? 'Nonaktifkan Admin' : 'Aktifkan Admin' }}
                                </button>
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

@push('scripts')
<script>
    function confirmLogout() {
        if (confirm("Apakah Anda yakin ingin keluar dari akun ini?")) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
@endpush
