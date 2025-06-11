@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/purchase.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="purchase-form">
                <h2 class="text-center mb-4 fw-bold" style="color:#3F5FAF;">Catat Pembelian Obat</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Jumlah item yang ingin dibeli -->
                <div class="mb-3">
                    <label for="jumlah_item" class="form-label">Jumlah Produk Berbeda</label>
                    <input type="number" id="jumlah_item" class="form-control" min="1" value="1">
                </div>
                <button type="button" class="btn btn-secondary mb-3" onclick="generateForms()">Buat Form Produk</button>

                <!-- Form Dinamis -->
                <form action="{{ route('medicines.purchase.store') }}" method="POST">
                    @csrf

                    <div id="produkContainer"></div>

                    <div class="mb-3">
                        <label for="diskon" class="form-label">Diskon Total (%)</label>
                        <input type="number" name="diskon" class="form-control" min="0" max="100" value="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Proses Semua Pembelian</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function generateForms() {
        const count = parseInt(document.getElementById('jumlah_item').value);
        const container = document.getElementById('produkContainer');
        container.innerHTML = '';

        for (let i = 0; i < count; i++) {
            container.innerHTML += `
                <div class="card p-3 mb-3 border">
                    <h5 class="mb-2">Produk #${i + 1}</h5>

                    <div class="mb-2">
                        <label>Kode Obat</label>
                        <input type="text" name="items[${i}][kode_obat]" class="form-control kode_obat" data-index="${i}" required>
                    </div>

                    <div class="mb-2">
                        <label>Nama Obat</label>
                        <input type="text" name="items[${i}][nama_obat]" class="form-control nama_obat" readonly>
                    </div>

                    <div class="mb-2">
                        <label>Harga</label>
                        <input type="text" name="items[${i}][harga]" class="form-control harga" readonly>
                    </div>

                    <div class="mb-2">
                        <label>Batch</label>
                        <select name="items[${i}][batch]" class="form-control batch" required></select>
                    </div>

                    <div class="mb-2">
                        <label>Jumlah</label>
                        <input type="number" name="items[${i}][jumlah]" class="form-control" required>
                    </div>
                </div>
            `;
        }

        setTimeout(() => {
            document.querySelectorAll('.kode_obat').forEach(input => {
                input.addEventListener('input', handleKodeObatChange);
            });
        }, 100);
    }

    function handleKodeObatChange(e) {
        const kodeObat = e.target.value;
        const index = e.target.dataset.index;
        const namaInput = document.getElementsByName(`items[${index}][nama_obat]`)[0];
        const hargaInput = document.getElementsByName(`items[${index}][harga]`)[0];
        const batchSelect = document.getElementsByName(`items[${index}][batch]`)[0];

        if (kodeObat) {
            fetch('/admin/medicines/get-medicine-batches/' + kodeObat)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        namaInput.value = data.medicines[0].nama_obat;
                        hargaInput.value = data.medicines[0].harga;

                        batchSelect.innerHTML = '<option value="">Pilih Batch</option>';
                        data.medicines.forEach(medicine => {
                            const option = document.createElement('option');
                            option.value = medicine.batch;
                            option.textContent = `Batch ${medicine.batch} - Exp: ${medicine.exp_date} - Stok: ${medicine.quantity}`;
                            batchSelect.appendChild(option);
                        });
                    } else {
                        namaInput.value = '';
                        hargaInput.value = '';
                        batchSelect.innerHTML = '<option value="">Pilih Batch</option>';
                        alert('Obat tidak ditemukan!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mencari data obat.');
                });
        } else {
            namaInput.value = '';
            hargaInput.value = '';
            batchSelect.innerHTML = '<option value="">Pilih Batch</option>';
        }
    }
</script>

@endsection
