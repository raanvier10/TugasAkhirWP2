@extends('layouts.app')

@section('title', 'Laporan Stok - Inventory ATK')

@section('content')
<h4 class="page-title">
    <i class="bi bi-file-earmark-text"></i> Laporan Stok
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-table me-2"></i>Data Stok Barang</span>
        <button onclick="window.print()" class="btn btn-sm btn-primary">
            <i class="bi bi-printer me-1"></i>Cetak
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabelStok">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stok Awal</th>
                        <th>Stok Sekarang</th>
                        <th>Status</th>
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
                        <td>
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
    $('#tabelStok').DataTable({
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
});
</script>
@endpush
