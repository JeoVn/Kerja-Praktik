@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/sedikitstok.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backhome.css') }}">
    @endpush

@section('content')

 <div class="container-fluid">
           <div class="page-header">
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('admin.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 home-link">
            <i class="fas fa-home"></i> Kembali ke Home
            </a>
        @elseif(auth()->user()->role == 'owner')
            <a href="{{ route('owner.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 home-link">
            <i class="fas fa-home"></i> Kembali ke Home
            </a>
        @endif
        </div>
        
<div class="container mt-4">
    <h2 class="mb-4">Obat dengan Stok Hampir Habis ( < 20)</h2>

    @if($lowStockMedicines->isEmpty())
        <div class="alert alert-info">Tidak ada obat dengan stok kurang dari 20.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-warning">
                    <tr>
                       
                        <th scope="col">Gambar</th>
                        <th scope="col">Kode Obat</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Stok</th>
                        <th scope="col" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                
                    @foreach($lowStockMedicines as $medicine)
                    <tr>
                        <td>
                            @if($medicine->gambar)
                                <img src="{{ asset($medicine->gambar) }}" alt="{{ $medicine->nama_obat }}" class="table-img">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="table-img">
                            @endif
                        </td>
                        <td>{{ $medicine->kode_obat }}</td>
                        <td>{{ $medicine->batch }}</td>
                        <td>{{ $medicine->nama_obat }}</td>
                        <td>
                            <span class="badge bg-warning text-dark" style="font-size: 1rem;">
                                {{ $medicine->jumlah }}
                            </span>
                        </td>
                        <td>
                            @if(auth()->user()->role == 'admin')
                                <!-- Admin Link -->
                                <a href="{{ route('admin.detail', $medicine->id) }}" class="btn btn-sm btn-outline-warning w-100">
                                    Detail
                                </a>
                            @elseif(auth()->user()->role == 'owner')
                                <!-- Owner Link -->
                                <a href="{{ route('owner.admin.detail', $medicine->id) }}" class="btn btn-sm btn-outline-warning w-100">
                                    Detail
                                </a>
                            @endif
                    </td>

                 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
