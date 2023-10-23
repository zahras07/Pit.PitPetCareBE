<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Hewan;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HewanApiController extends Controller
{
    public function index($pelanggan_id)
    {
        try {
            $varhewans= Hewan::where('pelanggan_id', $pelanggan_id)->get();
    
            $results = [];
            foreach ($varhewans as $hewan) {
                $pelanggan = Pelanggan::where('id', $hewan->pelanggan_id)->first();

                $jenishewan = DB::table('jenis_hewan')->where('id_jenis_hewan', $hewan->jenis_hewan)->first();
                $result = [
                    "id"            => $hewan->id,
                    "pelanggan_id" => $pelanggan->id,
                    'pelanggan_name' => $pelanggan->nama_pelanggan,
                    "nama_hewan" => $hewan->nama_hewan,
                    "jenis_hewan" => $jenishewan->nama_jenis,
                    "umur" => $this->konversiHariKeTahunBulanHari($hewan->umur),
                    "berat" => $hewan->berat,
                ];
        
                $results[] = $result;
            }
        
            return response(
                [
                    'message'   => "Berhasil Mengambil data Hewan",
                    'data'      => $results,
                ], 
                Response::HTTP_OK
            );
        } catch(Exception $e){
            // Tangani kesalahan umum
            return response(
                [
                    'message'   => $e->getMessage(),
                    'data'      => null,
                ], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    function konversiHariKeTahunBulanHari($jumlahHari) {
        // Menghitung tahun, bulan, dan sisa hari
        $tahun = floor($jumlahHari / 365);
        $sisaHari = $jumlahHari % 365;
        
        $bulan = floor($sisaHari / 30);
        $sisaHari = $sisaHari % 30;
        
        // Membuat string hasil
        $hasil = '';
        
        if ($tahun > 0) {
            $hasil .= $tahun . ' tahun ';
        }
        
        if ($bulan > 0) {
            $hasil .= $bulan . ' bulan ';
        }
        
        if ($sisaHari > 0) {
            $hasil .= $sisaHari . ' hari ';
        }
        
        return trim($hasil);
    }

    public function hewan(Request $request)
    {
        try {
           
          
            
            $pelanggan = DB::table('pelanggans')->where('user_id', auth()->user()->id)->first();

            if($pelanggan==null){
                return response(
                    [
                        'message'   => "Pelanggan tidak ditemukan",
                        'data'      => null,
                    ], 
                    Response::HTTP_BAD_REQUEST
                );
            }

            $hewan = new Hewan();
            $hewan->pelanggan_id = $pelanggan->id;
            $hewan->nama_hewan = $request->input('nama_hewan');
            $hewan->jenis_hewan = $request->input('jenis_hewan');
            $hewan->umur = $request->input('umur');
            $hewan->berat = $request->input('berat');
            $hewan->save();
        
            return response(
                [
                    'message'   => "Berhasil Menambah Hewan",
                    'data'      => $hewan,
                ], 
                Response::HTTP_OK
            );
        } catch(Exception $e){
            // Tangani kesalahan umum
            return response(
                [
                    'message'   => $e->getMessage(),
                    'data'      => null,
                ], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
