@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backhome.css') }}">
     
    @endpush

@section('content')

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

    <h2>Tambah Obat</h2>

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

    <form action="{{ route('medicines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Gambar Obat</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" id="imageInput" onchange="previewImage()">
            <div id="imagePreview" style="margin-top: 10px;">
                <img id="previewImage" src="" alt="Gambar Obat" style="max-width: 100%; max-height: 200px; display: none;">
            </div>
        </div>

        <div class="mb-3">
            <label>Kode Obat</label>
            <input type="text" name="kode_obat" value="{{ old('kode_obat') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" value="{{ old('nama_obat') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Exp</label>
            <input type="date" name="tanggal_exp" value="{{ old('tanggal_exp') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bentuk Obat</label>
            <select name="bentuk_obat" class="form-control" required>
                <option value="">-- Pilih Bentuk Obat --</option>
                @foreach(['Tablet', 'Kapsul', 'Sirup', 'Salep', 'Lainnya'] as $bentuk)
                    <option value="{{ $bentuk }}" {{ old('bentuk_obat') == $bentuk ? 'selected' : '' }}>{{ $bentuk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
                <label>Jenis Penyakit</label>
                <select name="penyakit[]" class="form-control" multiple required>
                <option value="">-- Pilih Jenis Penyakit --</option>
                @foreach($penyakit as $item)
                    <option value="{{ $item->id }}"
                {{ in_array($item->id, old('penyakit', $selectedPenyakit ?? [])) ? 'selected' : '' }}>
                {{ $item->nama_penyakit }}
            </option>
    @endforeach
</select>

        </div>

        <div class="mb-3">
            <label>Jenis Obat</label>
            <select name="jenis_obat" class="form-control" required>
                <option value="">-- Pilih Jenis Obat --</option>
                @foreach(['Obat Bebas', 'Obat Bebas Terbatas', 'Obat Keras dan Psikotropika', 'Obat Golongan Narkotika'] as $jenis)
                    <option value="{{ $jenis }}" {{ old('jenis_obat') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" value="{{ old('jumlah') }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
function previewImage() {
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('previewImage');
    
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
</script>
@endsection
