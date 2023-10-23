<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $jumlahPelanggan = Pelanggan::count();
        $jumlahHewan = Hewan::count();
        $jumlahTransaksi = Transaksi::count();
        $totalKas = Transaksi::sum('harga');

        return view('dashboard.index', [
            'jumlahPelanggan' => $jumlahPelanggan,
            'jumlahHewan' => $jumlahHewan,
            'jumlahTransaksi' => $jumlahTransaksi,
            'totalPemasukan' => $totalKas,
        ]);
    }
}