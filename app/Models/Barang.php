<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'stok_awal',
        'stok_sekarang',
    ];

    public function stokMasuk()
    {
        return $this->hasMany(StokMasuk::class);
    }

    public function stokKeluar()
    {
        return $this->hasMany(StokKeluar::class);
    }
}
