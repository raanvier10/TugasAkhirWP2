<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total data barang
        $totalBarang = Barang::count();
        
        // Total transaksi masuk (jumlah record)
        $totalTransaksiMasuk = StokMasuk::count();
        
        // Total transaksi keluar (jumlah record)
        $totalTransaksiKeluar = StokKeluar::count();
        
        // Total stok masuk (jumlah barang)
        $totalStokMasuk = StokMasuk::sum('jumlah');
        
        // Total stok keluar (jumlah barang)
        $totalStokKeluar = StokKeluar::sum('jumlah');
        
        // Barang dengan stok rendah (≤ 10)
        $stokRendah = Barang::where('stok_sekarang', '<=', 10)
            ->orderBy('stok_sekarang')
            ->get();
        
        // Total barang dengan stok rendah
        $totalStokRendah = $stokRendah->count();
        
        return view('dashboard', compact(
            'totalBarang',
            'totalTransaksiMasuk',
            'totalTransaksiKeluar',
            'totalStokMasuk',
            'totalStokKeluar',
            'stokRendah',
            'totalStokRendah'
        ));
    }
}
