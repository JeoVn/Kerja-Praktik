@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/owner/home.css') }}">
@endpush

@section('content')
<div class="owner-dashboard">
    <h2 class="dashboard-header"> AA Apotek Anugrah </h2>

    <!-- Profile Icon -->
    <div class="user-profile">
        <a href="{{ route('profile') }}" title="Profil Saya" style="text-decoration:none;">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            </svg>
        </a>
    </div>

    <!-- Menu Navigasi -->
    <div class="owner-menu">
        <div class="btn btn-danger">
            <a href="{{ route('owner.medicines.expiring') }}" class="text-white text-decoration-none">
                🔔 Obat Hampir Expired
            </a>
        </div>
        <div class="btn btn-warning">
            <a href="{{ route('owner.medicines.sedikitstok') }}" class="text-white text-decoration-none">
                ⚠️ Obat Hampir Habis
            </a>
        </div>
        <div class="btn btn-primary">
            <a href="{{ route('register') }}" class="text-white text-decoration-none">
                ➕ Registrasi Admin
            </a>
        </div>
        <div class="btn btn-success">
            <a href="{{ route('owner.transaksi') }}" class="text-white text-decoration-none">
                Lihat Transaksi
            </a>
        </div>
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
