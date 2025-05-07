@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Obat</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicines.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <label>Gambar Obat</label><br>
            @if($medicine->gambar)
                <img src="{{ asset($medicine->gambar) }}" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label>Kode Obat</label>
            <input type="text" name="kode_obat" value="{{ old('kode_obat', $medicine->kode_obat) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" value="{{ old('nama_obat', $medicine->nama_obat) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $medicine->harga) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Exp</label>
            <input type="date" name="tanggal_exp" value="{{ old('tanggal_exp', $medicine->tanggal_exp) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bentuk Obat</label>
            <select name="bentuk_obat" class="form-control" required>
                @foreach(['Tablet', 'Kapsul', 'Sirup', 'Salep', 'Lainnya'] as $bentuk)
                    <option value="{{ $bentuk }}" {{ old('bentuk_obat', $medicine->bentuk_obat) == $bentuk ? 'selected' : '' }}>{{ $bentuk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Penyakit</label>
            <select name="jenis_penyakit" class="form-control" required>
                @foreach(['Batuk', 'Pilek & Flu', 'Demam & Nyeri', 'Masalah Pencernaan', 'Alergi', 'Masalah THT', 'Masalah Mata', 'Kondisi Kulit', 'Infeksi', 'Tulang & Sendi', 'Kesuburan', 'Lainnya'] as $jenis)
                    <option value="{{ $jenis }}" {{ old('jenis_penyakit', $medicine->jenis_penyakit) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Obat</label>
            <select name="jenis_obat" class="form-control" required>
                @foreach(['Obat Bebas', 'Obat Bebas Terbatas', 'Obat Keras dan Psikotropika', 'Obat Golongan Narkotika'] as $jenis)
                    <option value="{{ $jenis }}" {{ old('jenis_obat', $medicine->jenis_obat) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $medicine->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" value="{{ old('jumlah', $medicine->jumlah) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
