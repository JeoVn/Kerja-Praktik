@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="purchase-form">
                <h2 class="text-center mb-4" style="font-weight: bold; color:#3F5FAF;">Tambah Stok Obat</h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Form to add stock -->
                <form action="{{ route('medicines.addStock', $medicine->id) }}" method="POST">
                    @csrf
                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Stok yang Ditambahkan</label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control" required min="1">
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Tambah Stok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
