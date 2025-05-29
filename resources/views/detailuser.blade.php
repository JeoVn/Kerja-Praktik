@extends('layouts.app')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-detail {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .product-detail img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product-info {
            flex: 1;
            padding-left: 20px;
        }

        .product-info h3 {
            font-size: 24px;
            font-weight: bold;
        }

        .product-price {
            font-size: 20px;
            color: #e74c3c;
            margin-top: 10px;
        }

        .product-description {
            margin-top: 20px;
            font-size: 16px;
        }

        .btn-stock {
            margin-top: 20px;
        }

        .filters-button {
            font-size: 20px;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Detail Produk</h2>

    <!-- Button to toggle filter (visible only on mobile) -->
    <div class="d-md-none text-end mb-3">
        <button id="filterToggle" class="filters-button btn btn-primary">☰ Filter</button>
    </div>

    <div class="row product-detail">
        <!-- Product Image -->
        <div class="col-md-4">
            <img src="{{ asset($medicine->gambar) }}" alt="{{ $medicine->nama_obat }}">
        </div>

        <!-- Product Info -->
        <div class="col-md-7 product-info">
            <h3>{{ $medicine->nama_obat }}</h3>
            <p class="product-price">Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>

            <!-- Stock and Availability -->
            <p class="text-info">
                <strong>{{ $medicine->jumlah > 0 ? 'STOK Tersedia' : 'STOK Habis' }}</strong>
                {{ $medicine->jumlah > 0 ? 'Segera ke Apotik' : '' }}
            </p>

            <div class="btn-stock">
                <a href="{{ route('cart.add', $medicine->id) }}" class="btn btn-success">Tambah ke Keranjang</a>
            </div>

            <!-- Description -->
            <div class="product-description">
                <h5>Deskripsi</h5>
                <p>{{ $medicine->deskripsi }}</p>
            </div>
        </div>
    </div>

    <footer class="text-center mt-5">
        <p>&copy; A.A Apotek Anugrah Palembang, All rights reserved.</p>
    </footer>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterToggle = document.getElementById('filterToggle');

        if (filterToggle) {
            filterToggle.addEventListener('click', function () {
                alert('Filter function can be added here!');
            });
        }
    });
</script>
@endpush