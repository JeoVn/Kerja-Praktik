@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/purchase.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="purchase-form">
                <h2 class="text-center mb-4" style="font-weight: bold; color:#3F5FAF;">Tambah Batch Baru Obat</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('medicines.addStock.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="kode_obat" class="form-label">Kode Obat</label>
                        <input type="text" id="kode_obat" name="kode_obat" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat</label>
                        <input type="text" id="nama_obat" name="nama_obat" class="form-control" readonly required>
                    </div>

                    <div class="mb-3">
                        <label for="bentuk_obat" class="form-label">Bentuk Obat</label>
                        <select id="bentuk_obat" name="bentuk_obat" class="form-control" required>
                            <option value=""> Bentuk Obat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_obat" class="form-label">Jenis Obat</label>
                        <select id="jenis_obat" name="jenis_obat" class="form-control" required>
                            <option value=""> Jenis Obat</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="penyakit" class="form-label">Jenis Penyakit</label>
                        <select id="penyakit" name="penyakit[]" class="form-control" multiple required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" id="harga" name="harga" class="form-control" readonly required>
                    </div>

                    <div class="mb-3">
                        <label for="batch" class="form-label">Batch (Otomatis)</label>
                        <input type="number" id="batch" name="batch" class="form-control" readonly required>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Stok</label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_exp" class="form-label">Tanggal Expiry</label>
                        <input type="date" id="tanggal_exp" name="tanggal_exp" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Tambah Batch Baru</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
  // 1. Ambil elemen form
  const kodeInput = document.getElementById('kode_obat');

  kodeInput.addEventListener('input', function () {
    const kodeObat = this.value.trim();
    console.log('🔎 Ketik kode_obat:', kodeObat);

    if (!kodeObat) {
      clearFields();
      return;
    }

    // show spinner kalau pakai spinner
    fetch('/admin/medicines/get-medicine-batches-stock/' + kodeObat)
      .then(r => {
        console.log('🔄 fetch status:', r.status);
        return r.json();
      })
      .then(data => {
        console.log('📦 Data JSON:', data);

        if (!data.success) {
          clearFields();
          alert('Obat tidak ditemukan!');
          return;
        }

        const rep = data.representative;

        // Isi field teks
        document.getElementById('nama_obat').value = rep.nama_obat;
        document.getElementById('harga').value     = rep.harga;

        // Isi dropdown bentuk_obat
        const bentuk = document.getElementById('bentuk_obat');
        bentuk.innerHTML = `<option value="${rep.bentuk_obat}" selected>${rep.bentuk_obat}</option>`;

        // Isi dropdown jenis_obat
       // Isi dropdown jenis_obat
        const jenis = document.getElementById('jenis_obat');
        jenis.innerHTML = `<option value="${rep.jenis_obat}" selected>${rep.jenis_obat}</option>`;

        // Isi dropdown jenis_penyakit
        const ps = document.getElementById('penyakit');
        ps.innerHTML = '';
        rep.jenis_penyakit.forEach(p => {
          const opt = document.createElement('option');
          opt.value = p.id;
          opt.textContent = p.nama_penyakit;
          opt.selected = true;
          ps.appendChild(opt);
        });

        // Hitung batch selanjutnya
        let last = 0;
        data.medicines.forEach(m => last = Math.max(last, parseInt(m.batch)));
        document.getElementById('batch').value = last + 1;
      })
      .catch(err => {
        console.error('❌ Fetch error:', err);
        alert('Gagal mengambil data.');
      });
  });

  // Fungsi bersihkan form
  function clearFields() {
    document.getElementById('nama_obat').value = '';
    document.getElementById('harga').value     = '';
    document.getElementById('batch').value     = '';
    document.getElementById('bentuk_obat').innerHTML = '<option value=""> Bentuk Obat</option>';
    document.getElementById('penyakit').innerHTML     = '';
    document.getElementById('jenis_obat').innerHTML = '<option value=""> Jenis Obat</option>';
  }
</script>
@endsection

