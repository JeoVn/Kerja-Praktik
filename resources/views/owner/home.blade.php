@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    .owner-dashboard {
        max-width: 900px;
        margin: 30px auto;
    }
    .dashboard-header {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 700;
        font-size: 1.8rem;
        color: #333;
    }
    /* List group item styling */
    .medicine-list-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 20px;
        border-radius: 8px;
        background: #f9f9f9;
        margin-bottom: 12px;
        box-shadow: 0 2px 6px rgb(0 0 0 / 0.05);
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
    .medicine-price, .medicine-stock {
        font-size: 0.95rem;
        margin-bottom: 4px;
    }
    .medicine-price {
        color: #dc3545;
        font-weight: 700;
    }
    .btn-detail {
        min-width: 120px;
    }

    /* Navigation menu */
    .owner-menu {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    .owner-menu .btn {
        padding: 10px 18px;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="owner-dashboard">

    <h2 class="dashboard-header">Dashboard Owner</h2>

    <div class="owner-menu">
            <a href="{{ route('owner.medicines.expiring') }}" class="btn btn-danger mb-3">
                🔔 Lihat Obat Hampir Expired
        </a>
            <a href="{{ route('owner.medicines.sedikitstok') }}" class="btn btn-danger mb-3">
                ⚠️ Lihat Obat Hampir Habis Stok
            </a>    
        <a href="{{ route('register') }}" class="btn btn-primary">➕ Registrasi Admin</a>
    </div>

    @if($medicines->isEmpty())
        <div class="alert alert-info text-center">Belum ada obat yang terdaftar.</div>
    @else
        <div>
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
        </div>
    @endif

</div>
@endsection
