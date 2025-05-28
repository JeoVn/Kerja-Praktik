@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Obat</h2>
    <div class="card">
        <img src="{{ asset($medicine->gambar) }}" class="card-img-top" alt="Gambar Obat">
        <div class="card-body">
            <h5 class="card-title">{{ $medicine->nama_obat }}</h5>
            <p class="card-text">Kode: {{ $medicine->kode_obat }}</p>
            <p class="card-text">Harga: Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>
            <p class="card-text">Bentuk: {{ $medicine->bentuk_obat }}</p>
            <p class="card-text">Jenis: {{ $medicine->jenis_obat }}</p>
            <p class="card-text">Deskripsi: {{ $medicine->deskripsi }}</p>
            <p class="card-text">Jumlah: {{ $medicine->jumlah }}</p>
            <p class="card-text">Tanggal Exp: {{ $medicine->tanggal_exp }}</p>
        </div>
    </div>
</div>
@endsection