<!-- <div class="filter-sidebar p-3 bg-white shadow rounded mb-4">

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0 font-weight-bold">Filters</h5>
        <a href="{{ route('medicines.index') }}" class="text-muted small">Hapus semua</a>
    </div> -->

    <!-- Jenis Obat -->
    <!-- <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Jenis Obat</h6>
        <div class="bg-light border rounded p-2 shadow-sm">
            @foreach($jenisObat as $jenis)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jenis_obat[]" value="{{ $jenis->id }}"
                           {{ in_array($jenis->id, request()->get('jenis_obat', [])) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $jenis->nama }}
                    </label>
                </div>
            @endforeach
        </div>
    </div> -->

    <!-- Penyakit -->
    <!-- <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Sakit</h6>
        <div class="bg-light border rounded p-2 shadow-sm">
            @foreach($penyakit as $item)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="penyakit[]" value="{{ $item->id }}"
                           {{ in_array($item->id, request()->get('penyakit', [])) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $item->nama }}
                    </label>
                </div>
            @endforeach
        </div>
    </div> -->

    <!-- Bentuk Obat -->
    <!-- <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Bentuk Obat</h6>
        <div class="bg-light border rounded p-2 shadow-sm">
            @foreach($bentukObat as $bentuk)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="bentuk_obat[]" value="{{ $bentuk->id }}"
                           {{ in_array($bentuk->id, request()->get('bentuk_obat', [])) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $bentuk->nama }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

</div> -->


<!-- <div class="filter-sidebar p-3 bg-white shadow rounded mb-4">

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0 font-weight-bold">Filters</h5>
        <a href="{{ route('medicines.index') }}" class="text-muted small">Hapus semua</a>
    </div> -->

    <!-- Jenis Obat -->
    <!-- <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Jenis Obat</h6>
        @foreach($jenisObat as $jenis)
    <input type="checkbox" name="jenis_obat[]" value="{{ $jenis }}"
        {{ in_array($jenis, request()->get('jenis_obat', [])) ? 'checked' : '' }}>
    <label>{{ $jenis }}</label>
            </div>
        @endforeach
    </div> -->

    
    <!-- Penyakit -->
    <!-- <div class="mb-3">
        <label>Jenis Penyakit</label><br>
        @foreach($penyakit as $item)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="penyakit[]" value="{{ $item->id_jenispensyakit }}"
                    {{ in_array($item->id_jenispensyakit, old('penyakit', $selectedPenyakit ?? [])) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $item->nama_jenispensyakit }}</label>
            </div>
        @endforeach
    </div>
 -->

    <!-- Bentuk Obat -->
    <!-- <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Bentuk Obat</h6>
        @foreach($bentukObat as $bentuk)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="bentuk_obat[]" value="{{ $bentuk }}"
                       {{ in_array($bentuk, request()->get('bentuk_obat', [])) ? 'checked' : '' }}>
                <label class="form-check-label">
                    {{ $bentuk }}
                </label>
            </div>
        @endforeach
    </div>
</div> -->
<!-- 
<link rel="stylesheet" href="{{ asset('css/admin/filters.css') }}">
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterToggle = document.getElementById('filterToggle');
        const filterSidebar = document.getElementById('filterSidebar');
        const closeFilter = document.getElementById('closeFilter'); -->
<!-- 
        // Tampilkan sidebar ketika tombol "Filter" diklik
        filterToggle.addEventListener('click', function () {
            filterSidebar.classList.add('active');
        });

        // Sembunyikan sidebar ketika tombol "Tutup" diklik
        closeFilter.addEventListener('click', function () {
            filterSidebar.classList.remove('active');
        });
    }); -->
<!-- </script>
<div id="filterSidebar" class="filter-sidebar p-3 bg-white shadow rounded">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0 font-weight-bold">Filters</h5>
        <button id="closeFilter" class="btn btn-sm btn-light">Tutup</button>
    </div> -->

    <!-- Jenis Obat -->
    <!-- <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Jenis Obat</h6>
        @foreach($jenisObat as $jenis)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="jenis_obat[]" value="{{ $jenis }}"
                       {{ in_array($jenis, request()->get('jenis_obat', [])) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $jenis }}</label>
            </div>
        @endforeach
    </div> -->

    <!-- Penyakit -->
    <!-- <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Jenis Penyakit</h6>
        @foreach($penyakit as $item)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="penyakit[]" value="{{ $item->id_jenispensyakit }}"
                       {{ in_array($item->id_jenispensyakit, old('penyakit', $selectedPenyakit ?? [])) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $item->nama_jenispensyakit }}</label>
            </div>
        @endforeach
    </div> -->

    <!-- Bentuk Obat -->
    <!-- <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Bentuk Obat</h6>
        @foreach($bentukObat as $bentuk)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="bentuk_obat[]" value="{{ $bentuk }}"
                       {{ in_array($bentuk, request()->get('bentuk_obat', [])) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $bentuk }}</label>
            </div>
        @endforeach
    </div>
</div> -->

<!-- <style>
    /* Sidebar styling */
    .filter-sidebar {
        position: fixed;
        top: 0;
        right: -300px; /* Awalnya tersembunyi di luar layar */
        width: 300px;
        height: 100%;
        background-color: #fff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        transition: right 0.3s ease-in-out;
        z-index: 1050;
    }

    .filter-sidebar.active {
        right: 0; /* Muncul ke layar */
    }
</style> -->



<div class="form-group">
    <label for="jenis_obat">Jenis Obat</label>
    <select name="jenis_obat" id="jenis_obat" class="form-control">
        <option value="">-- Semua Jenis --</option>
        @foreach ($jenisObat as $jenis)
            <option value="{{ $jenis }}" {{ request('jenis_obat') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="bentuk_obat">Bentuk Obat</label>
    <select name="bentuk_obat" id="bentuk_obat" class="form-control">
        <option value="">-- Semua Bentuk --</option>
        @foreach ($bentukObat as $bentuk)
            <option value="{{ $bentuk }}" {{ request('bentuk_obat') == $bentuk ? 'selected' : '' }}>{{ $bentuk }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="penyakit">Jenis Penyakit</label>
    <select name="penyakit[]" id="penyakit" class="form-control" multiple>
        @foreach ($penyakit as $p)
            <option value="{{ $p->id }}" {{ in_array($p->id, (array) request('penyakit')) ? 'selected' : '' }}>
                {{ $p->nama }}
            </option>
        @endforeach
    </select>
</div>
