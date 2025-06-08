@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Stok untuk Obat: {{ $medicine->nama_obat }}</h2>

    <form action="{{ route('medicines.updateStock', $medicine->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="jumlah">Jumlah Stok</label>
            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_exp">Tanggal Expired Baru</label>
            <input type="date" name="tanggal_exp" id="tanggal_exp" value="{{ old('tanggal_exp', $medicine->tanggal_exp) }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Stok</button>
        <a href="{{ route('admin.home') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
