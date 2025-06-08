@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-4 rounded shadow bg-blue-custom">
                <h2 class="text-center mb-4" style="font-weight: bold; color:#3F5FAF;">Catat Pembelian Obat</h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Form to process the purchase -->
                <form action="{{ route('medicines.purchase.store') }}" method="POST">
                    @csrf <!-- CSRF Token for security -->

                    <!-- Medicine Code -->
                    <div class="mb-3">
                        <label for="kode_obat" class="form-label">Kode Obat</label>
                        <input type="text" id="kode_obat" name="kode_obat" class="form-control" required>
                    </div>

                    <!-- Medicine Name -->
                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat</label>
                        <input type="text" id="nama_obat" name="nama_obat" class="form-control" required>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Proses Pembelian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
