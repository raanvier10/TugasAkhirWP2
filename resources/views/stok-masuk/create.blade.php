@extends('layouts.app')

@section('title', 'Tambah Stok Masuk - Inventory ATK')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <i class="bi bi-box-arrow-in-down me-2"></i>Tambah Stok Masuk
            </h4>
            <a href="{{ route('stok-masuk.index') }}" class="btn btn-secondary">
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

                @if($barangs->count() == 0)
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Belum ada data barang. <a href="{{ route('barang.create') }}">Tambah barang dulu</a>
                    </div>
                @else
                <form action="{{ route('stok-masuk.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="barang_id" class="form-label">
                            Pilih Barang <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('barang_id') is-invalid @enderror" 
                                id="barang_id" 
                                name="barang_id" 
                                required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}" 
                                        data-stok="{{ $barang->stok_sekarang }}"
                                        data-satuan="{{ $barang->satuan }}"
                                        {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                    {{ $barang->kode_barang }} - {{ $barang->nama_barang }} (Stok: {{ $barang->stok_sekarang }} {{ $barang->satuan }})
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">
                            Jumlah Masuk <span class="text-danger">*</span>
                        </label>
                        <input type="number" 
                               class="form-control @error('jumlah') is-invalid @enderror" 
                               id="jumlah" 
                               name="jumlah" 
                               value="{{ old('jumlah') }}"
                               min="1"
                               placeholder="Masukkan jumlah"
                               required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">
                            Tanggal <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('tanggal') is-invalid @enderror" 
                               id="tanggal" 
                               name="tanggal" 
                               value="{{ old('tanggal', date('Y-m-d')) }}"
                               required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i>Simpan Stok Masuk
                        </button>
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
