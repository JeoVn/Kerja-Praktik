
<div class="form-group mb-3">
    <label class="font-weight-bold">Jenis Obat</label>
    <div class="bg-light border rounded p-2 shadow-sm">
        @foreach($jenisObat as $jenis)
            <div class="form-check">
                <input class="form-check-input"
                       type="checkbox"
                       name="jenis_obat[]"
                       value="{{ $jenis }}"
                       {{ in_array($jenis, (array)request()->get('jenis_obat', [])) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $jenis }}</label>
            </div>
        @endforeach
    </div>
</div>

<div class="form-group mb-3">
    <label class="font-weight-bold">Bentuk Obat</label>
    <select name="bentuk_obat" id="bentuk_obat" class="form-control">
        <option value="">-- Semua Bentuk --</option>
        @foreach ($bentukObat as $bentuk)
            <option value="{{ $bentuk }}" {{ request('bentuk_obat') == $bentuk ? 'selected' : '' }}>{{ $bentuk }}</option>
        @endforeach
    </select>
</div>

<div class="form-group mb-3">
    <label class="font-weight-bold">Jenis Penyakit</label>
    <select name="penyakit[]" id="penyakit" class="form-control" multiple>
        @foreach ($penyakit as $p)
            <option value="{{ $p->id }}" {{ in_array($p->id, (array)request('penyakit')) ? 'selected' : '' }}>
                {{ $p->nama_penyakit ?? $p->nama }}
            </option>
        @endforeach
    </select>
</div>