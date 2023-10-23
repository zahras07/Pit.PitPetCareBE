<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Pelanggan;
use App\Models\Paket;
use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Dokter;

class TransaksiController extends Controller
{
    public function index()
    {

        $transaksis = [];
        $transaksis = Transaksi::leftJoin('dokters', 'transaksis.dokter_id', '=', 'dokters.id')
        ->join('pelanggans', 'transaksis.pelanggan_id', '=', 'pelanggans.id')
        ->join('hewans', 'transaksis.hewan_id', '=', 'hewans.id')
        ->join('pakets', 'transaksis.paket_id', '=', 'pakets.id')
        ->join('layanans', 'transaksis.layanan_id', '=', 'layanans.id')
        ->select('transaksis.id','pelanggans.nama_pelanggan', 'hewans.nama_hewan', 'layanans.nama_layanan', 
        'pakets.nama_paket', 'dokters.nama_dokter','transaksis.tgl_transaksi', 'transaksis.total', 'transaksis.status',)
        ->get();
    
        return view('transaksi.index', ['transaksis' => $transaksis]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pelanggan_id' => 'required',
            'hewan_id' => 'required',
            'layanan_id' => 'required',
            'paket_id' => 'required',
            'dokter_id' => 'nullable',
            'tgl_transaksi' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);
    }

    public function show(Transaksi $transaksi)
    {

    }
    public function edit(Request $request, $id)
    {
        return view('transaksi.edit', [
            'transaksi' => Transaksi::find($id)
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:belum dikonfirmasi,proses,selesai',
        ]);
    
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->input('status');
        $transaksi->save();
    
        return redirect()->route('transaksi.index')
            ->with('success', 'Status transaksi berhasil diupdate.');
    }

    public function destroy(Request $request, $id)
    {
        Transaksi::destroy($id);
        return redirect('/transaksi')->with('pesan','Data berhasil dihapus');
    }
}
