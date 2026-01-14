@extends('layouts.app')

@section('title', 'Laporan Stok - DAFIA ATK')

@section('content')
<h4 class="page-title">
    <i class="bi bi-file-earmark-text"></i> Laporan Stok
</h4>

<!-- Header khusus cetak -->
<div class="print-only text-center mb-3" style="display:none;">
    <h5 class="mb-2">Laporan Stok</h5>
    <style>
        @page { size: A4; margin: 12mm; }
        @media print {
            body { -webkit-print-color-adjust: exact; }
            /* Sembunyikan semua elemen non-esensial saat print */
            .sidebar, .top-navbar, footer, .card-header, .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate { display: none !important; }
            /* Sembunyikan title di layar, pakai header print-only */
            .page-title { display: none !important; }
            .print-only { display: block !important; }
            .main-content, .page-content, .card, .card-body { margin: 0; padding: 0; box-shadow: none; border: none; }
            table { width: 100% !important; border-collapse: collapse !important; }
            .table thead { display: table-header-group; background-color: #f0f0f0 !important; }
            .table th, .table td { border: 1px solid #000 !important; padding: 6px !important; color: #000 !important; }
            tr { page-break-inside: avoid; }
            /* Hilangkan kolom Status hanya saat print */
            .kolom-status { display: none !important; }
        }
    </style>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-table me-2"></i>Data Stok Barang</span>
        <button onclick="printStok()" class="btn btn-sm btn-primary">
            <i class="bi bi-printer me-1"></i>Cetak
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle table-sm" id="tabelStok">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stok Awal</th>
                        <th>Stok Sekarang</th>
                        <th class="kolom-status">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->satuan }}</td>
                        <td>{{ $barang->stok_awal }}</td>
                        <td>{{ $barang->stok_sekarang }}</td>
                        <td class="kolom-status">
                            @if($barang->stok_sekarang == 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($barang->stok_sekarang <= 10)
                                <span class="badge bg-warning text-dark">Rendah</span>
                            @else
                                <span class="badge bg-success">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-3">Belum ada data barang</td>
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
    const dt = $('#tabelStok').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Tidak ada data yang cocok",
            paginate: { next: ">", previous: "<" }
        }
    });

    // Saat cetak PDF, tampilkan semua baris lalu kembalikan ke semula
    window.printStok = function() {
        const originalLen = dt.page.len();
        dt.page.len(-1).draw();
        setTimeout(function() {
            window.print();
            dt.page.len(originalLen).draw();
        }, 200);
    }
});
</script>
@endpush
