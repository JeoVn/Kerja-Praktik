@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/expiring.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backhome.css') }}">
    @endpush

@section('content')
<br>
<br>
<br>
 <div class="container-fluid">
           <div class="page-header">
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('admin.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 home-link">
            <i class="fas fa-home"></i> Kembali ke Home
            </a>
        @elseif(auth()->user()->role == 'owner')
            <a href="{{ route('owner.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 home-link">
            <i class="fas fa-home"></i> Kembali ke Home
            </a>
        @endif
        </div>
<div class="container">
    <h2>Daftar Obat Hampir Expired (≤ 6 Bulan)</h2>

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Obat</th>
                <th>Kode</th>
                <th>Batch</th>
                <th>Jumlah</th>
                <th>Tanggal Exp</th>
                <th>Sisa Hari</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($medicines as $index => $medicine)
                @php
                    $sisaHari = \Carbon\Carbon::now()->diffInDays($medicine->tanggal_exp, false);
                    $badgeClass = $sisaHari <= 30 ? 'badge-merah' : ($sisaHari <= 90 ? 'badge-kuning' : 'badge-hijau');
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        @if($medicine->gambar)
                            <img src="{{ asset($medicine->gambar) }}" alt="{{ $medicine->nama_obat }}" class="table-img">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="table-img">
                        @endif
                    </td>
                    <td>{{ $medicine->nama_obat }}</td>
                    <td>{{ $medicine->kode_obat }}</td>
                    <td>{{ $medicine->batch }}</td>
                    <td>{{ $medicine->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($medicine->tanggal_exp)->format('d-m-Y') }}</td>
                    <td>
                        <span class="badge-hari {{ $badgeClass }}">
                            {{ $sisaHari }} hari lagi
                        </span>
                    </td>
                    <td>
                        @if(auth()->user()->role == 'admin')
                            <!-- Admin Link -->
                            <a href="{{ route('admin.detail', $medicine->id) }}" class="btn btn-sm btn-outline-warning w-100">
                                Detail
                            </a>
                        @elseif(auth()->user()->role == 'owner')
                            <!-- Owner Link -->
                            <a href="{{ route('owner.admin.detail', $medicine->id) }}" class="btn btn-sm btn-outline-warning w-100">
                                Detail
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada obat yang akan expired dalam 6 bulan ke depan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
