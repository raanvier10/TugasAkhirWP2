@extends('layouts.app')

@section('title', 'Stok Keluar - Inventory ATK')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">
        <i class="bi bi-box-arrow-up me-2"></i>Stok Keluar
    </h4>
    <a href="{{ route('stok-keluar.create') }}" class="btn btn-danger">
        <i class="bi bi-plus-circle me-1"></i>Tambah Stok Keluar
    </a>
</div>

{{-- Alert Success --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Tanggal</th>
                        <th width="15%">Kode</th>
                        <th width="30%">Nama Barang</th>
                        <th width="15%">Jumlah Keluar</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stokKeluars as $index => $stok)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $stok->tanggal->format('d/m/Y') }}</td>
                        <td><span class="badge bg-secondary">{{ $stok->barang->kode_barang }}</span></td>
                        <td>{{ $stok->barang->nama_barang }}</td>
                        <td>
                            <span class="badge bg-danger badge-stok">
                                <i class="bi bi-dash"></i> {{ $stok->jumlah }} {{ $stok->barang->satuan }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('stok-keluar.destroy', $stok) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus data ini? Stok barang akan ditambah kembali.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                Belum ada data stok keluar.
                                <a href="{{ route('stok-keluar.create') }}">Tambah stok keluar</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($stokKeluars->count() > 0)
        <div class="mt-3">
            <small class="text-muted">Total: <strong>{{ $stokKeluars->count() }}</strong> transaksi</small>
        </div>
        @endif
    </div>
</div>
@endsection
