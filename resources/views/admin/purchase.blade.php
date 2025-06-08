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

                    <!-- Batch Selection (auto-filled based on medicine code) -->
                    <div class="mb-3">
                        <label for="batch" class="form-label">Batch</label>
                        <select id="batch" name="batch" class="form-control" required>
                            <option value="">Pilih Batch</option>
                            <!-- Options will be populated dynamically -->
                        </select>
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

            // Make a fetch request to search for the medicine and get available batches
            fetch('/admin/medicines/get-medicine-batches/' + kodeObat)
                .then(response => response.json())
                .then(data => {
                    console.log('Data yang diterima:', data);  // Log the response from server
                    if (data.success) {
                        // Populate the medicine name and price fields
                        document.getElementById('nama_obat').value = data.medicines[0].nama_obat;
                        document.getElementById('harga').value = data.medicines[0].harga;

                        // Populate the batch dropdown
                        const batchSelect = document.getElementById('batch');
                        batchSelect.innerHTML = '<option value="">Pilih Batch</option>'; // Clear previous options

                        data.medicines.forEach(medicine => {
                            const option = document.createElement('option');
                            option.value = medicine.batch;
                            option.textContent = `Batch ${medicine.batch} - Exp: ${medicine.exp_date} - Stok: ${medicine.quantity}`;
                            batchSelect.appendChild(option);
                        });
                    } else {
                        // Clear the fields if medicine not found
                        document.getElementById('nama_obat').value = '';
                        document.getElementById('harga').value = '';
                        document.getElementById('batch').innerHTML = '<option value="">Pilih Batch</option>';
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
            document.getElementById('batch').innerHTML = '<option value="">Pilih Batch</option>';
        }
    });
</script>

@endsection
