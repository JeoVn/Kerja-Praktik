@extends('layouts.app')

@push('styles')
<style>
    .dashboard-header {
        margin-top: 30px;
        margin-bottom: 20px;
    }
    .card {
        margin-bottom: 30px;
    }
    .table thead th {
        background-color: #6b8dd6;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h2 class="dashboard-header">Dashboard Owner</h2>

    @if(Auth::user()->role === 'owner')
        <div class="mb-4">
            <a href="{{ route('register') }}" class="btn btn-primary">Registrasi Admin Baru</a>
        </div>
    @endif

    <!-- Daftar Obat -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Daftar Obat</h5>
        </div>
        <div class="card-body p-0">
            @if($medicines->isEmpty())
                <p class="p-3">Belum ada data obat tersedia.</p>
            @else
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Obat</th>
                                <th>Jenis Obat</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Tanggal Exp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicines as $index => $medicine)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $medicine->nama_obat }}</td>
                                    <td>{{ $medicine->jenis_obat }}</td>
                                    <td>{{ $medicine->jumlah }}</td>
                                    <td>Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</td>
                                    <td>{{ $medicine->tanggal_exp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5>Riwayat Transaksi</h5>
        </div>
        <div class="card-body">
            <p><em>Belum ada data riwayat transaksi.</em></p>
        </div>
    </div>
</div>
@endsection
