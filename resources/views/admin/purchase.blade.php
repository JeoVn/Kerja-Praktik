@extends('layouts.app')

@section('content')
<!-- Link to your purchase.css file -->
<link rel="stylesheet" href="{{ asset('css/admin/purchase.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="purchase-form">
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

                    <!-- Medicine Name (auto-filled) -->
                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat</label>
                        <input type="text" id="nama_obat" name="nama_obat" class="form-control" required readonly>
                    </div>

                    <!-- Medicine Price (auto-filled) -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" id="harga" name="harga" class="form-control" required readonly>
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

<!-- Add the JavaScript below the form for better performance -->
<script>
    document.getElementById('kode_obat').addEventListener('input', function () {
        var kodeObat = this.value;

        // Checking if the input is not empty
        if (kodeObat) {
            console.log('Mencari obat dengan kode: ' + kodeObat);  // Debugging log

            // Make a fetch request to search for the medicine
            fetch('/admin/medicines/search-medicine/' + kodeObat)
                .then(response => response.json())
                .then(data => {
                    console.log('Data yang diterima:', data);  // Log the response from server
                    if (data.success) {
                        // Populate the medicine name and price fields
                        document.getElementById('nama_obat').value = data.medicine.nama_obat;
                        document.getElementById('harga').value = data.medicine.harga;
                    } else {
                        // Clear the fields if medicine not found
                        document.getElementById('nama_obat').value = '';
                        document.getElementById('harga').value = '';
                        alert('Obat tidak ditemukan!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);  // Log any errors
                    alert('Terjadi kesalahan saat mencari data obat.');
                });
        } else {
            // Clear the fields if no code is entered
            document.getElementById('nama_obat').value = '';
            document.getElementById('harga').value = '';
        }
    });
</script>

@endsection
