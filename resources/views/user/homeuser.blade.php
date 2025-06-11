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
            <form method="GET" action="{{ route('medicines.index') }}" class="search-container">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Obat..." class="search-input">
                <button type="submit" class="search-icon" style="background:none; border:none;">🔍</button>
            </form>
          <button class="filters-btn" id="filterToggle">☰ Filters</button>

            
        </div>
    </div>

   
    <!-- Sidebar Filter -->
    <div class="filter-sidebar-mobile" id="filterSidebar">
        <div class="filter-sidebar-content">
            <button class="btn-close mb-3 float-end" id="closeFilter"></button>
            <h6 class="filter-title">Filters</h6>
            <form method="GET" action="{{ route('medicines.index') }}">
                <div class="filter-group">
                    <h6>Jenis Obat</h6>
                    @foreach($jenisObat as $jenis)
                    <div class="filter-item">
                        <input type="checkbox" name="jenis_obat[]" id="jenis-m-{{ strtolower($jenis) }}" value="{{ $jenis }}">
                        <label for="jenis-m-{{ strtolower($jenis) }}">{{ $jenis }}</label>
                    </div>
                    @endforeach
                </div>

                <div class="filter-group">
                    <h6>Jenis Penyakit</h6>
                    @foreach($penyakit as $p)
                    <div class="filter-item">
                        <input type="checkbox" id="penyakit-m-{{ $p->id }}" name="penyakit[]" value="{{ $p->id }}">
                        <label for="penyakit-m-{{ $p->id }}">{{ $p->nama_penyakit }}</label>
                    </div>
                    @endforeach
                </div>

                <div class="filter-group">
                    <h6>Bentuk Obat</h6>
                    @foreach($bentukObat as $bentuk)
                    <div class="filter-item">
                        <input type="checkbox" name="bentuk_obat[]" id="bentuk-m-{{ strtolower($bentuk) }}" value="{{ $bentuk }}">
                        <label for="bentuk-m-{{ strtolower($bentuk) }}">{{ $bentuk }}</label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Terapkan Filter</button>
            </form>
        </div>
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
                            <!-- <a href="{{ route('user.detail', $medicine->id) }}" class="btn">Informasi Obat</a> -->
                             <a href="{{ route('user.detail', $medicine->id) }}" class="btn">Informasi Obat</a>


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

<!-- @push('scripts')
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
@endpush -->