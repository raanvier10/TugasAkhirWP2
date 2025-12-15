@extends('layouts.app')

@section('title', 'Tambah Stok Keluar - Inventory ATK')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <i class="bi bi-box-arrow-up me-2"></i>Tambah Stok Keluar
            </h4>
            <a href="{{ route('stok-keluar.index') }}" class="btn btn-secondary">
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
                        Tidak ada barang dengan stok tersedia. <a href="{{ route('stok-masuk.create') }}">Tambah stok masuk dulu</a>
                    </div>
                @else
                <form action="{{ route('stok-keluar.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="barang_id" class="form-label">
                            Pilih Barang <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('barang_id') is-invalid @enderror" 
                                id="barang_id" 
                                name="barang_id" 
                                required
                                onchange="updateMaxJumlah()">
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
                            Jumlah Keluar <span class="text-danger">*</span>
                        </label>
                        <input type="number" 
                               class="form-control @error('jumlah') is-invalid @enderror" 
                               id="jumlah" 
                               name="jumlah" 
                               value="{{ old('jumlah') }}"
                               min="1"
                               placeholder="Masukkan jumlah"
                               required>
                        <div class="form-text" id="stok-info">Pilih barang untuk melihat stok tersedia</div>
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
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-save me-1"></i>Simpan Stok Keluar
                        </button>
                        <button type="reset" class="btn btn-outline-secondary" onclick="resetForm()">
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

@push('scripts')
<script>
function updateMaxJumlah() {
    const select = document.getElementById('barang_id');
    const jumlahInput = document.getElementById('jumlah');
    const stokInfo = document.getElementById('stok-info');
    
    const selectedOption = select.options[select.selectedIndex];
    
    if (selectedOption.value) {
        const stok = selectedOption.dataset.stok;
        const satuan = selectedOption.dataset.satuan;
        
        jumlahInput.max = stok;
        stokInfo.innerHTML = `Stok tersedia: <strong>${stok} ${satuan}</strong>`;
        stokInfo.classList.add('text-primary');
    } else {
        jumlahInput.removeAttribute('max');
        stokInfo.innerHTML = 'Pilih barang untuk melihat stok tersedia';
        stokInfo.classList.remove('text-primary');
    }
}

function resetForm() {
    document.getElementById('stok-info').innerHTML = 'Pilih barang untuk melihat stok tersedia';
    document.getElementById('jumlah').removeAttribute('max');
}

// Run on page load if barang already selected
document.addEventListener('DOMContentLoaded', updateMaxJumlah);
</script>
@endpush
