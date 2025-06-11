@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Transaksi Pembelian Obat</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Batch</th>
                    <th>Diskon (%)</th>
                    <th>Total</th>
                    <th>Admin</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchases as $index => $purchase)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $purchase->kode_obat }}</td>
                    <td>{{ $purchase->nama_obat }}</td>
                    <td>Rp{{ number_format($purchase->harga, 0, ',', '.') }}</td>
                    <td>{{ $purchase->jumlah }}</td>
                    <td>{{ $purchase->batch }}</td>
                    <td>{{ $purchase->diskon ?? '-' }}</td>
                    <td>Rp{{ number_format($purchase->harga * $purchase->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $purchase->admin->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($purchase->created_at)->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
