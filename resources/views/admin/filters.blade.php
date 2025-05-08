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


<div class="filter-sidebar p-3 bg-white shadow rounded mb-4">

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0 font-weight-bold">Filters</h5>
        <a href="{{ route('medicines.index') }}" class="text-muted small">Hapus semua</a>
    </div>

    <!-- Jenis Obat -->
    <div class="mb-3">
        <h6 class="text-primary font-weight-bold">Jenis Obat</h6>
        @foreach($jenisObat as $jenis)
    <input type="checkbox" name="jenis_obat[]" value="{{ $jenis }}"
        {{ in_array($jenis, request()->get('jenis_obat', [])) ? 'checked' : '' }}>
    <label>{{ $jenis }}</label>
            </div>
        @endforeach
    </div>

    
    <!-- Penyakit -->
    <div class="mb-3">
        <label>Jenis Penyakit</label><br>
        @foreach($penyakit as $item)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="penyakit[]" value="{{ $item->id_jenispensyakit }}"
                    {{ in_array($item->id_jenispensyakit, old('penyakit', $selectedPenyakit ?? [])) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $item->nama_jenispensyakit }}</label>
            </div>
        @endforeach
    </div>


    <!-- Bentuk Obat -->
    <div class="mb-3">
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
</div>
