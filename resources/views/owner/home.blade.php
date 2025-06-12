@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    .owner-dashboard {
        max-width: 1000px;
        margin: 30px auto;
        padding: 0 15px;
    }
    .dashboard-header {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 700;
        font-size: 1.9rem;
        color: #333;
    }
    .owner-menu {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    .owner-menu .btn {
        padding: 10px 18px;
        font-weight: 600;
    }
    .search-bar {
        max-width: 400px;
        margin: 0 auto 25px auto;
        display: flex;
        gap: 10px;
    }
    .medicine-list-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 20px;
        border-radius: 8px;
        background: #f9f9f9;
        margin-bottom: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: background-color 0.2s ease;
    }
    .medicine-list-item:hover {
        background-color: #e6f0ff;
    }
    .medicine-img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        border-radius: 6px;
        background: #fff;
        border: 1px solid #ddd;
        padding: 6px;
    }
    .medicine-info {
        flex-grow: 1;
    }
    .medicine-name {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: #222;
    }
    .medicine-price {
        color: #dc3545;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .medicine-stock {
        font-size: 0.95rem;
        color: #555;
    }
    .btn-detail {
        min-width: 120px;
    }
</style>
@endpush

@section('content')
<div class="owner-dashboard">
    <h2 class="dashboard-header">Dashboard Owner</h2>

    <!-- Menu Navigasi -->
    <div class="owner-menu">
        <a href="{{ route('owner.medicines.expiring') }}" class="btn btn-danger">
            🔔 Obat Hampir Expired
        </a>
        <a href="{{ route('owner.medicines.sedikitstok') }}" class="btn btn-warning">
            ⚠️ Obat Hampir Habis
        </a>
        <a href="{{ route('register') }}" class="btn btn-primary">
            ➕ Registrasi Admin
        </a>
        <a href="{{ route('owner.transaksi') }}" class="btn btn-success">Lihat Transaksi</a>

    </div>
 <div class="user-profile">
                <a href="{{ route('profile') }}" title="Profil Saya" style="text-decoration:none;">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    </svg>
                </a>
            </div>
    <!-- Search Bar -->
    <form method="GET" action="{{ route('owner.home') }}" class="search-bar">
        <input type="text" name="search" class="form-control" placeholder="Cari nama obat..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-primary">Cari</button>
    </form>

    <!-- Daftar Obat -->
    @if($medicines->isEmpty())
        <div class="alert alert-info text-center">Tidak ada obat yang ditemukan.</div>
    @else
        @foreach($medicines as $medicine)
            <div class="medicine-list-item">
                <img src="{{ asset($medicine->gambar) }}" alt="Gambar {{ $medicine->nama_obat }}" class="medicine-img">
                <div class="medicine-info">
                    <div class="medicine-name">{{ $medicine->nama_obat }}</div>
                    <div class="medicine-price">Rp {{ number_format($medicine->harga, 0, ',', '.') }}</div>
                    <div class="medicine-stock">Stok: {{ $medicine->jumlah }}</div>
                </div>
                <a href="{{ route('owner.admin.detail', $medicine->id) }}" class="btn btn-info btn-detail">Detail Obat</a>
            </div>
        @endforeach
    @endif
</div>
@endsection
