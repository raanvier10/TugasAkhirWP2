<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokKeluar;
use Illuminate\Http\Request;

class StokKeluarController extends Controller
{
    public function index()
    {
        $stokKeluars = StokKeluar::with('barang')->latest()->get();
        return view('stok-keluar.index', compact('stokKeluars'));
    }

    public function create()
    {
        $barangs = Barang::where('stok_sekarang', '>', 0)->orderBy('nama_barang')->get();
        return view('stok-keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $barang = Barang::find($request->barang_id);
        
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1|max:' . ($barang ? $barang->stok_sekarang : 0),
            'tanggal' => 'required|date',
        ], [
            'jumlah.max' => 'Jumlah keluar tidak boleh melebihi stok yang tersedia (' . ($barang ? $barang->stok_sekarang : 0) . ' ' . ($barang ? $barang->satuan : '') . ')',
        ]);

        // Simpan stok keluar
        StokKeluar::create($request->all());

        // Update stok_sekarang pada barang
        $barang->decrement('stok_sekarang', $request->jumlah);

        return redirect()->route('stok-keluar.index')
            ->with('success', 'Stok keluar berhasil dicatat! Stok ' . $barang->nama_barang . ' berkurang ' . $request->jumlah . ' ' . $barang->satuan);
    }


    public function destroy(StokKeluar $stokKeluar)
    {
        // Tambah kembali stok_sekarang karena data stok keluar dihapus
        $stokKeluar->barang->increment('stok_sekarang', $stokKeluar->jumlah);
        
        $stokKeluar->delete();

        return redirect()->route('stok-keluar.index')
            ->with('success', 'Data stok keluar berhasil dihapus!');
    }
}
