@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/owner/transaksi.css') }}">
@endpush
@section('content')
<header class="mb-3">
    <nav>
        @if(Route::currentRouteName() != 'owner.home')
            <a href="{{ route('owner.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2">
                <i class="fas fa-arrow-circle-left me-2"></i> Kembali ke Home
            </a>
        @endif
    </nav>
</header>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="text-blue fw-bold">
                        <i class="fas fa-receipt me-2"></i> Daftar Transaksi Pembelian Obat
                    </h2>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fas fa-filter me-2"></i> Filter Transaksi</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ url()->current() }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Admin</label>
                            <select class="form-select" name="admin_id">
                                <option value="">Pilih Admin</option>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ request('admin_id') == $admin->id ? 'selected' : '' }}>
                                        {{ $admin->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="btn-group w-100">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search me-2"></i> Filter</button>
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary"><i class="fas fa-sync-alt me-2"></i> Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Transaksi</h5>
                    <span class="text-muted small">Menampilkan {{ $purchases->count() }} transaksi</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nama Obat</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Batch</th>
                                    <th class="text-center">Diskon (%)</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Admin</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->nama_obat }}</td>
                                        <td class="text-end">Rp{{ number_format($purchase->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $purchase->jumlah }}</td>
                                        <td class="text-center">{{ $purchase->batch ?? '-' }}</td>
                                        <td class="text-center">{{ $purchase->diskon ?? 0 }}</td>
                                        <td class="text-end fw-bold">
                                            Rp{{ number_format(($purchase->harga * $purchase->jumlah) * (1 - ($purchase->diskon ?? 0) / 100), 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">{{ $purchase->admin->name ?? '-' }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($purchase->created_at)->format('d M Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Tidak ada transaksi ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body text-center">
                    <h6>Total Transaksi</h6>
                    <h4 class="fw-bold">{{ $purchases->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body text-center">
                    <h6>Total Nilai</h6>
                    <h4 class="fw-bold">
                        Rp{{ number_format($purchases->sum(function($p) { 
                            return ($p->harga * $p->jumlah) * (1 - ($p->diskon ?? 0) / 100); 
                        }), 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info shadow">
                <div class="card-body text-center">
                    <h6>Total Item</h6>
                    <h4 class="fw-bold">{{ $purchases->sum('jumlah') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
