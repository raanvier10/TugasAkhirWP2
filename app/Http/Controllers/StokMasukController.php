<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use Illuminate\Http\Request;

class StokMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokMasuks = StokMasuk::with('barang')->latest()->get();
        return view('stok-masuk.index', compact('stokMasuks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::orderBy('nama_barang')->get();
        return view('stok-masuk.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        // Simpan stok masuk
        StokMasuk::create($request->all());

        // Update stok_sekarang pada barang
        $barang = Barang::find($request->barang_id);
        $barang->increment('stok_sekarang', $request->jumlah);

        return redirect()->route('stok-masuk.index')
            ->with('success', 'Stok masuk berhasil dicatat! Stok ' . $barang->nama_barang . ' bertambah ' . $request->jumlah . ' ' . $barang->satuan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StokMasuk $stokMasuk)
    {
        // Kurangi stok_sekarang karena data stok masuk dihapus
        $stokMasuk->barang->decrement('stok_sekarang', $stokMasuk->jumlah);
        
        $stokMasuk->delete();

        return redirect()->route('stok-masuk.index')
            ->with('success', 'Data stok masuk berhasil dihapus!');
    }
}
