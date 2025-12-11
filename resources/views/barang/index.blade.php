@extends('layouts.app')

@section('title', 'Data Barang - Inventory ATK')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">
        <i class="bi bi-archive me-2"></i>Data Barang
    </h4>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>Tambah Barang
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
                        <th width="15%">Kode</th>
                        <th width="30%">Nama Barang</th>
                        <th width="10%">Satuan</th>
                        <th width="12%">Stok Awal</th>
                        <th width="13%">Stok Sekarang</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span class="badge bg-secondary">{{ $barang->kode_barang }}</span></td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->satuan }}</td>
                        <td>{{ $barang->stok_awal }}</td>
                        <td>
                            @if($barang->stok_sekarang == 0)
                                <span class="badge bg-danger badge-stok">Habis</span>
                            @elseif($barang->stok_sekarang <= 10)
                                <span class="badge bg-warning text-dark badge-stok">{{ $barang->stok_sekarang }}</span>
                            @else
                                <span class="badge bg-success badge-stok">{{ $barang->stok_sekarang }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('barang.edit', $barang) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('barang.destroy', $barang) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
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
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                Belum ada data barang.
                                <a href="{{ route('barang.create') }}">Tambah barang pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($barangs->count() > 0)
        <div class="mt-3">
            <small class="text-muted">Total: <strong>{{ $barangs->count() }}</strong> barang</small>
        </div>
        @endif
    </div>
</div>
@endsection
