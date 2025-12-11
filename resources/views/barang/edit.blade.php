@extends('layouts.app')

@section('title', 'Edit Barang - Inventory ATK')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i>Edit Barang
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

                <form action="{{ route('barang.update', $barang) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kode_barang" class="form-label">
                                Kode Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('kode_barang') is-invalid @enderror" 
                                   id="kode_barang" 
                                   name="kode_barang" 
                                   value="{{ old('kode_barang', $barang->kode_barang) }}"
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
                                   value="{{ old('nama_barang', $barang->nama_barang) }}"
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
                                @php
                                    $satuans = ['pcs', 'box', 'rim', 'lusin', 'pak'];
                                @endphp
                                @foreach($satuans as $satuan)
                                    <option value="{{ $satuan }}" {{ old('satuan', $barang->satuan) == $satuan ? 'selected' : '' }}>
                                        {{ $satuan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Info Stok</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-control bg-light">
                                        <small class="text-muted">Stok Awal:</small>
                                        <strong>{{ $barang->stok_awal }}</strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-control bg-light">
                                        <small class="text-muted">Stok Sekarang:</small>
                                        <strong class="{{ $barang->stok_sekarang <= 10 ? 'text-danger' : 'text-success' }}">
                                            {{ $barang->stok_sekarang }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">Stok dikelola melalui menu Stok Masuk & Stok Keluar.</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save me-1"></i>Update
                        </button>
                        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
