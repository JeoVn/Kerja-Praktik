@extends('layouts.app')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .filter-sidebar {
            height: 100%;
            background-color: #f4f7fa;
            padding: 15px;
            border-right: 1px solid #ddd;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .product-card {
            width: 100%;
            max-width: 250px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            border-radius: 10px;
            object-fit: cover;
            height: 200px;
        }
        .card-body {
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center mb-4">Dashboard Obat</h2>

    <!-- Filter Sidebar -->
    <div class="row">
        <div class="col-md-3 mb-4 filter-sidebar">
            <h5>Filters</h5>
            <form method="GET" action="{{ route('medicines.index') }}">
                <div class="mb-3">
                    <h6>Jenis Obat</h6>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="jenis_obat[]" value="Tablet">
                        <label class="form-check-label">Tablet</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="jenis_obat[]" value="Kapsul">
                        <label class="form-check-label">Kapsul</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="jenis_obat[]" value="Sirup">
                        <label class="form-check-label">Sirup</label>
                    </div>
                </div>

                <div class="mb-3">
                    <h6>Sakit</h6>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sakit[]" value="Sakit Kepala">
                        <label class="form-check-label">Sakit Kepala</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sakit[]" value="Demam">
                        <label class="form-check-label">Demam</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="sakit[]" value="Batuk">
                        <label class="form-check-label">Batuk</label>
                    </div>
                </div>

                <div class="mb-3">
                    <h6>Bentuk Obat</h6>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="bentuk_obat[]" value="Tablet">
                        <label class="form-check-label">Tablet</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="bentuk_obat[]" value="Salep">
                        <label class="form-check-label">Salep</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="bentuk_obat[]" value="Suntikan">
                        <label class="form-check-label">Suntikan</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="col-md-9">
            <div class="row product-grid">
                @forelse($medicines as $medicine)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="card product-card">
                            <img src="{{ asset($medicine->gambar) }}" class="card-img-top" alt="Gambar Obat">
                            <div class="card-body">
                                <h6 class="card-title">{{ $medicine->nama_obat }}</h6>
                                <p class="card-text text-primary">Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('detailuser.show', $medicine->id) }}" class="btn btn-info btn-sm">
    Informasi Obat
</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Tidak ada obat yang sesuai filter.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // If you have any additional JavaScript for functionality
    });
</script>
@endpush