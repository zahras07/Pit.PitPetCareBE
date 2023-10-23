<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index'); 
    }

    public function cetaksemua(Transaksi $transaksi)
    {
        $transaksis = Transaksi::with(['pelanggan','hewan', 'paket', 'layanan', 
        'dokter'])->get();
        $totalPemasukan = Transaksi::sum('total');

        $pdf = Pdf::loadView('laporan.cetaksemua', compact('transaksis', 'totalPemasukan'));
        return $pdf->download('laporan-pemasukan.pdf');

    }    
    public function cetakpertanggal($tglawal, $tglakhir){
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir: ".$tglakhir ]);
    
        $transaksis = Transaksi::with(['pelanggan', 'hewan', 'paket', 'layanan',
        'dokter'])->whereBetween('tgl_transaksi', [$tglawal, $tglakhir])
        ->latest()->get();
        $totalPemasukan = Transaksi::whereBetween('tgl_transaksi', [$tglawal, $tglakhir])
        ->sum('total');

        $pdf = PDF::loadView('laporan.cetakpertanggal', compact('transaksis', 'totalPemasukan'));

        $filename = 'laporan-pertanggal-'.$tglawal.'-'.$tglakhir.'.pdf';
        return $pdf->download($filename);

    }
}
