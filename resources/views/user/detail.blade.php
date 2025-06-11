@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/detail.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3F5FAF; height: 100px;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="36" height="36" class="me-2" style="object-fit:contain;">
        </a>
    </div>
</nav>

<div class="container">
    <div class="row align-items-center justify-content-center mt-4">
        <!-- Kontainer Gambar Obat di Tengah -->
        <div class="col-md-3 mb-3 d-flex justify-content-center align-items-center">
            <div class="border rounded shadow-sm p-2 bg-blue-custom" style="max-width: 180px;">
                <img src="{{ asset($medicine->gambar) }}" class="img-fluid" alt="Gambar Obat" style="max-height: 160px; object-fit: contain;">
            </div>
        </div>
        <!-- Kontainer Detail Obat -->
        <div class="col-md-8">
            <div class="medicine-detail bg-blue-custom rounded shadow-sm p-4 {{ $medicine->jenis_obat_class }}">
                <h2>{{ $medicine->nama_obat }}</h2>
                <p class="medicine-price">Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>
                <p class="medicine-type">
                    @if($medicine->jenis_obat == 'Obat Bebas')
                        <span class="badge bg-success">{{ $medicine->jenis_obat }}</span>
                    @elseif($medicine->jenis_obat == 'Obat Bebas Terbatas')
                        <span class="badge bg-primary">{{ $medicine->jenis_obat }}</span>
                    @elseif($medicine->jenis_obat == 'Obat Keras dan Psikotropika')
                        <span class="badge bg-danger">{{ $medicine->jenis_obat }}</span>
                    @elseif($medicine->jenis_obat == 'Obat Golongan Narkotika')
                        <span class="badge bg-warning text-dark">{{ $medicine->jenis_obat }}</span>
                    @else
                        <span class="badge bg-secondary">{{ $medicine->jenis_obat }}</span>
                    @endif
                </p>
                <p class="medicine-stock">
                     @if($medicine->jumlah < 20)
                        <span class="text-danger fw-bold">
                            ⚠️ Stok Sedikit, Segera Datang Ke Apotek.
                        </span>
                    @else
                        STOK Tersedia, Segera ke Apotek
                    @endif
                </p>

                <div class="medicine-description mt-3">
                    <p><strong>Deskripsi :</strong> <br> {{ $medicine->deskripsi }}</p>
                </div>

                <div class="medicine-details">
                    <p><strong>Kode Obat :</strong> {{ $medicine->kode_obat }}</p>
                    <p><strong>Bentuk Obat :</strong> {{ $medicine->bentuk_obat }}</p>
                    <p><strong>Jenis Penyakit :</strong>
                        @if($medicine->jenisPenyakit && $medicine->jenisPenyakit->count())
                            {{ $medicine->jenisPenyakit->pluck('nama_penyakit')->implode(', ') }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </p>
                 <p class="card-stock">Stok: {{ $totalJumlah }}</p>

                </div>

            
            </div>
        </div>
    </div>
</div>
@endsection