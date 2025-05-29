@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/expiring.css') }}">
@endpush

@section('content')
<div class="container">
    <h2>Daftar Obat Hampir Expired (≤ 6 Bulan)</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Kode</th>
                <th>Jumlah</th>
                <th>Tanggal Exp</th>
                <th>Sisa Hari</th>
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
                    <td>{{ $medicine->nama_obat }}</td>
                    <td>{{ $medicine->kode_obat }}</td>
                    <td>{{ $medicine->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($medicine->tanggal_exp)->format('d-m-Y') }}</td>
                    <td>
                        <span class="badge-hari {{ $badgeClass }}">
                            {{ $sisaHari }} hari lagi
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada obat yang akan expired dalam 6 bulan ke depan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
