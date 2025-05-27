<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <div class="row">
        @foreach($medicines as $medicine)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset($medicine->gambar) }}" class="card-img-top" alt="Gambar Obat">
                    <div class="card-body">
                        <h5 class="card-title">{{ $medicine->nama_obat }}</h5>
                        <p class="card-text">Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('medicines.show', $medicine->id) }}" class="btn btn-primary">Informasi Obat</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection -->
<!-- @extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Dashboard Obat</h2>
    <div class="row">
        @foreach($medicines as $medicine)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card medicine-card">
                    <img src="{{ asset($medicine->gambar) }}" class="card-img-top" alt="Gambar Obat">
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $medicine->nama_obat }}</h6>
                        <p class="card-text text-primary">Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('medicines.show', $medicine->id) }}" class="btn btn-info btn-sm">Informasi Obat</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="container-fluid mt-4">
    <div class="row"> -->
        <!-- Sidebar Filter -->
        <!-- <div class="col-md-3">
            <form method="GET" action="{{ route('medicines.index') }}">
            @include('admin.filters')

                <button type="submit" class="btn btn-primary mt-3 w-100">Terapkan Filter</button>
            </form>
        </div> -->

        
        <!-- @extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center mb-4">Dashboard Obat</h2>
    <div class="row"> -->
        <!-- Sidebar Filter -->
        <!-- <div class="col-md-3 mb-4">
            <form method="GET" action="{{ route('medicines.index') }}">
                @include('admin.filters')
                <button type="submit" class="btn btn-primary mt-3 w-100">Terapkan Filter</button>
            </form>
        </div> -->

        <!-- Daftar Obat -->
        <!-- <div class="col-md-9">
            <div class="row">
                @forelse($medicines as $medicine)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="card medicine-card h-100">
                            <img src="{{ asset($medicine->gambar) }}" class="card-img-top" alt="Gambar Obat">
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ $medicine->nama_obat }}</h6>
                                <p class="card-text text-primary">Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('medicines.show', $medicine->id) }}" class="btn btn-info btn-sm">Informasi Obat</a>
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
@endsection -->




@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/filters.css') }}">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center mb-4">Dashboard Obat</h2>

    <!-- Tombol toggle filter (muncul hanya di mobile) -->
    <div class="d-md-none text-end mb-3">
        <button id="filterToggle" class="btn btn-outline-primary">☰ Filter</button>
    </div>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3 mb-4 d-none d-md-block">
            <form method="GET" action="{{ route('medicines.index') }}">
                @include('admin.filters')
                <button type="submit" class="btn btn-primary mt-3 w-100">Terapkan Filter</button>
            </form>
        </div>

        <!-- Sidebar overlay di mobile -->
        <div id="filterSidebar" class="filter-sidebar-overlay d-md-none">
            <div class="filter-sidebar p-3 bg-white shadow rounded">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0 font-weight-bold">Filters</h5>
                    <button id="closeFilter" class="btn btn-sm btn-light">Tutup</button>
                </div>
                <form method="GET" action="{{ route('medicines.index') }}">
                    @include('admin.filters')
                    <button type="submit" class="btn btn-primary mt-3 w-100">Terapkan Filter</button>
                </form>
            </div>
        </div>

        <!-- Daftar Obat -->
        <div class="col-md-9">
            <div class="row">
                @forelse($medicines as $medicine)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="card medicine-card h-100">
                            <img src="{{ asset($medicine->gambar) }}" class="card-img-top" alt="Gambar Obat">
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ $medicine->nama_obat }}</h6>
                                <p class="card-text text-primary">Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('medicines.show', $medicine->id) }}" class="btn btn-info btn-sm">Informasi Obat</a>
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
        const filterToggle = document.getElementById('filterToggle');
        const filterSidebar = document.getElementById('filterSidebar');
        const closeFilter = document.getElementById('closeFilter');

        if (filterToggle && filterSidebar && closeFilter) {
            filterToggle.addEventListener('click', function () {
                filterSidebar.classList.add('active');
            });

            closeFilter.addEventListener('click', function () {
                filterSidebar.classList.remove('active');
            });
        }
    });
</script>
@endpush
