@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/expiring.css') }}">
<style>
    .table-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }
</style>
@endpush
<header>
        <nav>
            <!-- Add a Bigger Back Button with Icon -->
           @if(auth()->user()->role == 'admin')
                            <!-- Admin Link -->
                            <a href="{{ route('admin.home') }}" class="btn btn-link mb-3" style="font-size: 24px; color: #0d47a1;">
                               <i class="fas fa-arrow-circle-left"></i> Kembali ke Home
                            </a>
                        @elseif(auth()->user()->role == 'owner')
                            <!-- Owner Link -->
                            <a href="{{ route('owner.home') }}" class="btn btn-link mb-3" style="font-size: 24px; color: #0d47a1;">
                             <i class="fas fa-arrow-circle-left"></i> Kembali ke Home
                            </a>
                </a>
            @endif
            <!-- You can add other navigation menu items here -->
        </nav>
    </header>

@section('content')
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

                        <!-- <td>
                            <a href="{{ route('owner.admin.detail', $medicine->id) }}" class="btn btn-sm btn-outline-warning w-100">
                                Detail
                            </a>
                            <a href="{{ route('admin.detail', $medicine->id) }}" class="btn btn-sm btn-outline-warning w-100">
                                Detail
                            </a>
                        </td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
