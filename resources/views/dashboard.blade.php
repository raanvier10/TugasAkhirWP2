@extends('layouts.app')

@section('title', 'Dashboard - Inventory ATK')

@section('content')
<h4 class="page-title">
    <i class="bi bi-house-door"></i> Dashboard
</h4>

<!-- Row 1: Stats Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stats-card primary">
            <div class="icon-box">
                <i class="bi bi-archive"></i>
            </div>
            <div class="stats-info">
                <div class="label">Data Barang</div>
                <div class="value">{{ $totalBarang }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card success">
            <div class="icon-box">
                <i class="bi bi-box-arrow-in-down"></i>
            </div>
            <div class="stats-info">
                <div class="label">Data Barang Masuk</div>
                <div class="value">{{ $totalTransaksiMasuk }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card warning">
            <div class="icon-box">
                <i class="bi bi-box-arrow-up"></i>
            </div>
            <div class="stats-info">
                <div class="label">Data Barang Keluar</div>
                <div class="value">{{ $totalTransaksiKeluar }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Row 2: More Stats -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stats-card danger">
            <div class="icon-box">
                <i class="bi bi-tags"></i>
            </div>
            <div class="stats-info">
                <div class="label">Total Stok Masuk</div>
                <div class="value">{{ $totalStokMasuk }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card info">
            <div class="icon-box">
                <i class="bi bi-box-seam"></i>
            </div>
            <div class="stats-info">
                <div class="label">Total Stok Keluar</div>
                <div class="value">{{ $totalStokKeluar }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stats-card orange">
            <div class="icon-box">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div class="stats-info">
                <div class="label">Stok Minimum</div>
                <div class="value">{{ $totalStokRendah }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Stok Minimum -->
<div class="card">
    <div class="card-header d-flex align-items-center">
        <i class="bi bi-info-circle text-primary me-2"></i>
        Stok barang telah mencapai batas minimum
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="tabelStokMinimum">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stokRendah as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->satuan }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $barang->stok_sekarang == 0 ? 'bg-danger' : 'bg-warning text-dark' }}">
                                {{ $barang->stok_sekarang }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-3">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Semua stok barang dalam kondisi aman
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#tabelStokMinimum').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Tidak ada data yang cocok",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: ">",
                previous: "<"
            }
        },
        pageLength: 10,
        ordering: true
    });
});
</script>
@endpush
