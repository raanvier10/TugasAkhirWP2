<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function stok()
    {
        $barangs = Barang::orderBy('nama_barang')->get();
        return view('laporan.stok', compact('barangs'));
    }

    public function masuk(Request $request)
    {
        $query = StokMasuk::with('barang')->latest('tanggal');
        
        // Filter berdasarkan tanggal
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        }
        
        $stokMasuks = $query->get();
        $totalJumlah = $stokMasuks->sum('jumlah');
        
        return view('laporan.masuk', compact('stokMasuks', 'totalJumlah'));
    }

    public function keluar(Request $request)
    {
        $query = StokKeluar::with('barang')->latest('tanggal');
        
        // Filter berdasarkan tanggal
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        }
        
        $stokKeluars = $query->get();
        $totalJumlah = $stokKeluars->sum('jumlah');
        
        return view('laporan.keluar', compact('stokKeluars', 'totalJumlah'));
    }
}
