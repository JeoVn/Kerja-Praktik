@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/admin/edit.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<div class="container">
    <h2 class="text-center mb-4">Edit Obat</h2>

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

    <div class="row">
        <div class="col-md-4">
            <!-- Gambar Obat -->
            @if($medicine->gambar)
                <img src="{{ asset($medicine->gambar) }}" width="100%" class="img-fluid mb-3">
            @endif
        </div>
        <div class="col-md-8">
            <form action="{{ route('medicines.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="gambar">Ganti Gambar Obat</label>
                    <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                </div>

                <div class="mb-3">
                    <label for="kode_obat">Kode Obat</label>
                    <input type="text" id="kode_obat" name="kode_obat" value="{{ old('kode_obat', $medicine->kode_obat) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" id="nama_obat" name="nama_obat" value="{{ old('nama_obat', $medicine->nama_obat) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" value="{{ old('harga', $medicine->harga) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_exp">Tanggal Exp</label>
                    <input type="date" id="tanggal_exp" name="tanggal_exp" value="{{ old('tanggal_exp', $medicine->tanggal_exp) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="bentuk_obat">Bentuk Obat</label>
                    <select name="bentuk_obat" id="bentuk_obat" class="form-control" required>
                        @foreach(['Tablet', 'Kapsul', 'Sirup', 'Salep', 'Lainnya'] as $bentuk)
                            <option value="{{ $bentuk }}" {{ old('bentuk_obat', $medicine->bentuk_obat) == $bentuk ? 'selected' : '' }}>{{ $bentuk }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jenis_penyakit">Jenis Penyakit</label>
                    <select name="jenis_penyakit[]" id="jenis_penyakit" class="form-control" multiple required>
                        @foreach($penyakit as $p)
                            <option value="{{ $p->id }}" {{ in_array($p->id, $selectedPenyakit ?? []) ? 'selected' : '' }}>{{ $p->nama_penyakit }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Tekan Ctrl (atau Cmd di Mac) untuk memilih lebih dari satu.</small>
                </div>

                <div class="mb-3">
                    <label for="jenis_obat">Jenis Obat</label>
                    <select name="jenis_obat" id="jenis_obat" class="form-control" required>
                        @foreach(['Obat Bebas', 'Obat Bebas Terbatas', 'Obat Keras dan Psikotropika', 'Obat Golongan Narkotika'] as $jenis)
                            <option value="{{ $jenis }}" {{ old('jenis_obat', $medicine->jenis_obat) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $medicine->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $medicine->jumlah) }}" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('medicines.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection