@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/expiring.css') }}">
<style>
    .table-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Obat dengan Stok Hampir Habis (Kurang dari 20)</h2>

    @if($lowStockMedicines->isEmpty())
        <div class="alert alert-info">Tidak ada obat dengan stok kurang dari 20.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Stok</th>
                        <th scope="col" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowStockMedicines as $medicine)
                    <tr>
                        <td>
                            @if($medicine->gambar)
                                <img src="{{ asset($medicine->gambar) }}" alt="{{ $medicine->nama_obat }}" class="table-img">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="table-img">
                            @endif
                        </td>
                        <td>{{ $medicine->nama_obat }}</td>
                        <td>
                            <span class="badge bg-warning text-dark" style="font-size: 1rem;">
                                {{ $medicine->jumlah }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.detail', $medicine->id) }}" class="btn btn-sm btn-outline-warning w-100">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-4">Kembali ke Dashboard</a>
</div>
@endsection
