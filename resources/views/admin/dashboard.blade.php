@extends('layouts.app')
@section('head')
    <title>Dashboard Obat - AA Apotek Anugerah</title>
@endsection

@section('content')
<!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/filters.css') }}">
<div class="container-fluid">
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-left">
            <div class="logo-section">
                <div class="logo">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </div>
                <div class="company-name">
                    AA APOTEK ANUGERAH
                </div>
            </div>
        </div>
        
        <div class="header-right">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Cari Obat...">
                <div class="search-icon">🔍</div>
            </div>
            <button class="filters-btn d-md-none" id="filterToggle">
                ☰ Filters
            </button>
            <button class="filters-btn d-none d-md-inline-flex">
                ☰ Filters
            </button>
            <div class="user-profile">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="nav-tabs-container">
        <div class="nav-tabs-custom">
            <button class="nav-tab-item active">Home</button>
            <a href="{{ route('medicines.create') }}" class="nav-tab-item" style="text-decoration:none;">
                Tambah Stok
            </a>
            <button class="nav-tab-item">Kelola Stok</button>
            <button class="nav-tab-item">Dashboard</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Desktop Filter Sidebar -->
        <div class="filter-sidebar-desktop d-none d-md-block">
            <h6 class="filter-title">Filters</h6>
            
            <form method="GET" action="{{ route('medicines.index') }}">
                <div class="filter-group">
                    <h6>Jenis Obat</h6>
                    <div class="filter-item">
                        <input type="checkbox" id="obat-bebas" name="jenis[]" value="bebas">
                        <label for="obat-bebas">Obat Bebas</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="obat-bebas-terbatas" name="jenis[]" value="bebas-terbatas">
                        <label for="obat-bebas-terbatas">Obat Bebas Terbatas</label>
                    </div>
                    <div class="filter-item red-text">
                        <input type="checkbox" id="obat-keras" name="jenis[]" value="keras">
                        <label for="obat-keras">Obat Keras dan Psikotropika</label>
                    </div>
                    <div class="filter-item blue-text">
                        <input type="checkbox" id="obat-golongan" name="jenis[]" value="golongan">
                        <label for="obat-golongan">Obat Golongan Narkotika</label>
                    </div>
                </div>

                <div class="filter-group">
                    <h6>Sakit</h6>
                    <div class="filter-item">
                        <input type="checkbox" id="batuk-pilek" name="sakit[]" value="batuk-pilek">
                        <label for="batuk-pilek">Batuk, Pilek & Flu</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="demam-nyeri" name="sakit[]" value="demam-nyeri">
                        <label for="demam-nyeri">Demam & Nyeri</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="masalah-pencernaan" name="sakit[]" value="pencernaan">
                        <label for="masalah-pencernaan">Masalah Pencernaan</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="alergi" name="sakit[]" value="alergi">
                        <label for="alergi">Alergi</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="masalah-tht" name="sakit[]" value="hht">
                        <label for="masalah-tht">Masalah THT</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="masalah-mata" name="sakit[]" value="mata">
                        <label for="masalah-mata">Masalah Mata</label>
                    </div>
                </div>

                <div class="filter-group">
                    <h6>Bentuk Obat</h6>
                    <div class="filter-item">
                        <input type="checkbox" id="tablet" name="bentuk[]" value="tablet">
                        <label for="tablet">Tablet</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="kapsul" name="bentuk[]" value="kapsul">
                        <label for="kapsul">Kapsul</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="sirup" name="bentuk[]" value="sirup">
                        <label for="sirup">Sirup</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="salep" name="bentuk[]" value="salep">
                        <label for="salep">Salep</label>
                    </div>
                    <div class="filter-item">
                        <input type="checkbox" id="lainnya" name="bentuk[]" value="lainnya">
                        <label for="lainnya">Lainnya</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Terapkan Filter</button>
            </form>
        </div>


        <!-- Product Grid -->
        <div class="product-grid">
            <div class="grid-header d-none">
                <div class="results-text">Hapus semua</div>
            </div>
            
            <div class="products-container">
                @forelse($medicines as $index => $medicine)
                    <div class="medicine-card">
                        <div class="card-number"></div>
                        <div class="card-img-container">
                            <img src="{{ asset($medicine->gambar) }}" class="card-img-top" alt="{{ $medicine->nama_obat }}">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">{{ $medicine->nama_obat }}</h6>
                            <p class="card-price">Rp. {{ number_format($medicine->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('admin.detail', $medicine->id) }}" class="btn">Informasi Obat</a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Tidak ada obat yang sesuai filter.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

            // Close when clicking overlay
            filterSidebar.addEventListener('click', function(e) {
                if (e.target === filterSidebar) {
                    filterSidebar.classList.remove('active');
                }
            });

            
        }

        // Navigation tabs functionality
        const navTabs = document.querySelectorAll('.nav-tab-item');
        navTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                navTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        const searchIcon = document.querySelector('.search-icon');
        
        if (searchIcon) {
            searchIcon.addEventListener('click', function() {
                // Add search functionality here
                console.log('Search for:', searchInput.value);
            });
        }

        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    // Add search functionality here
                    console.log('Search for:', this.value);
                }
            });
        }
    });
</script>
@endpush