@extends('layouts.app')

@section('title', 'Tambah Barang - Inventory ATK')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <i class="bi bi-plus-circle me-2"></i>Tambah Barang Baru
            </h4>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                {{-- Tampilkan Error Validasi --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-triangle me-2"></i>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kode_barang" class="form-label">
                                Kode Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('kode_barang') is-invalid @enderror" 
                                   id="kode_barang" 
                                   name="kode_barang" 
                                   value="{{ old('kode_barang') }}"
                                   placeholder="Contoh: ATK-001"
                                   required>
                            @error('kode_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nama_barang" class="form-label">
                                Nama Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_barang') is-invalid @enderror" 
                                   id="nama_barang" 
                                   name="nama_barang" 
                                   value="{{ old('nama_barang') }}"
                                   placeholder="Contoh: Bolpoin Hitam"
                                   required>
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="satuan" class="form-label">
                                Satuan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('satuan') is-invalid @enderror" 
                                    id="satuan" 
                                    name="satuan" 
                                    required>
                                <option value="">-- Pilih Satuan --</option>
                                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>pcs</option>
                                <option value="box" {{ old('satuan') == 'box' ? 'selected' : '' }}>box</option>
                                <option value="rim" {{ old('satuan') == 'rim' ? 'selected' : '' }}>rim</option>
                                <option value="lusin" {{ old('satuan') == 'lusin' ? 'selected' : '' }}>lusin</option>
                                <option value="pak" {{ old('satuan') == 'pak' ? 'selected' : '' }}>pak</option>
                            </select>
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stok_awal" class="form-label">
                                Stok Awal <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control @error('stok_awal') is-invalid @enderror" 
                                   id="stok_awal" 
                                   name="stok_awal" 
                                   value="{{ old('stok_awal', 0) }}"
                                   min="0"
                                   required>
                            @error('stok_awal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Stok sekarang akan otomatis sama dengan stok awal.</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
