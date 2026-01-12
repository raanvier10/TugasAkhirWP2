@extends('layouts.app')

@section('title', 'Laporan Barang Keluar')

@section('content')
<h4 class="page-title">
    <i class="bi bi-file-earmark-arrow-up"></i> Laporan Barang Keluar
</h4>

<!-- Filter Tanggal -->
<div class="card mb-4 print-hide">
    <div class="card-body">
        <form action="{{ route('laporan.keluar') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="dari" class="form-label">Dari Tanggal</label>
                <input type="date" class="form-control" id="dari" name="dari" value="{{ request('dari') }}">
            </div>
            <div class="col-md-4">
                <label for="sampai" class="form-label">Sampai Tanggal</label>
                <input type="date" class="form-control" id="sampai" name="sampai" value="{{ request('sampai') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-filter me-1"></i>Filter
                </button>
                <a href="{{ route('laporan.keluar') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <!-- Header khusus cetak -->
    <div class="print-only text-center mb-3" style="display:none;">
        <h5 class="mb-2">Laporan Barang Keluar</h5>
        <style>
            @page { size: A4; margin: 12mm; }
            @media print {
                body { -webkit-print-color-adjust: exact; }
                .sidebar, .top-navbar, footer, .card-header, .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate, .print-hide, .page-title { display: none !important; }
                .print-only { display: block !important; }
                .main-content, .page-content, .card, .card-body { margin: 0; padding: 0; box-shadow: none; border: none; }
                table { width: 100% !important; border-collapse: collapse !important; }
                .table thead { display: table-header-group; background-color: #f0f0f0 !important; }
                .table th, .table td { border: 1px solid #000 !important; padding: 6px !important; color: #000 !important; }
                tr { page-break-inside: avoid; }
            }
        </style>
    </div>
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-table me-2"></i>Data Barang Keluar</span>
        <button onclick="printKeluar()" class="btn btn-sm btn-primary">
            <i class="bi bi-printer me-1"></i>Cetak
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle table-sm" id="tabelKeluar">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stokKeluars as $index => $stok)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $stok->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $stok->barang->kode_barang }}</td>
                        <td>{{ $stok->barang->nama_barang }}</td>
                        <td>{{ $stok->jumlah }}</td>
                        <td>{{ $stok->barang->satuan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-3">Belum ada data barang keluar</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($stokKeluars->count() > 0)
                <tfoot class="table-light">
                    <tr>
                        <th colspan="4" class="text-end">Total:</th>
                        <th>{{ $totalJumlah }}</th>
                        <th></th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const dtKeluar = $('#tabelKeluar').DataTable({
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

    window.printKeluar = function() {
        const originalLen = dtKeluar.page.len();
        dtKeluar.page.len(-1).draw();
        setTimeout(function() {
            window.print();
            dtKeluar.page.len(originalLen).draw();
        }, 200);
    }
});
</script>
@endpush
