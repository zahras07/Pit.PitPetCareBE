<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class DokterApiController extends Controller
{

    
    public function index()
    {
        try{
            $vardokters = Dokter::all();

            $results = [];
            foreach ($vardokters as $dokter) {
                $result = [
                    "id"          => $dokter->id,
                    "nama_dokter" => $dokter->nama_dokter,
                    "foto" => $dokter->foto,
                    "ttl" => $dokter->ttl,
                    "alamat_praktek" => $dokter->alamat_praktek,
                    "no_rek" => $dokter->no_rek,
                    "tgl_rek" => $dokter->tgl_rek,
                    "masa_berlaku" => $dokter->masa_berlaku,
                ];
        
                $results[] = $result;
            }
        
            return response(
                [
                    'message'   => "Berhasil Mengambil data Dokter",
                    'data'      => $results,
                ], 
                Response::HTTP_OK
            );
        }catch(Exception $e){
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

    public function detailDokter($id)
    {
        try{
            $dataDokter = DB::table('dokters')->where('id', $id)->first();

            if($dataDokter==null){
                return response(
                    [
                        'message'   => "Tidak ada data dokter",
                        'data'      => null,
                    ], 
                    Response::HTTP_BAD_REQUEST
                );
            }

            $jadwalDokter = DB::table('jadwal_dokter')->where('id_dokter', $id)->where('status', 'aktif')->get();

            $daftarHari = array(
                1 => "Senin",
                2 => "Selasa",
                3 => "Rabu",
                4 => "Kamis",
                5 => "Jumat",
                6 => "Sabtu",
                7 => "Minggu"
            );

            // Loop melalui data jadwal dokter dan mengganti "day" dengan nama hari
            foreach ($jadwalDokter as $jadwal) {
                $day = $jadwal->day; // Mengambil nilai "day" dari data jadwal dokter
                $namaHari = $daftarHari[$day]; // Mengonversi nilai "day" menjadi nama hari

                // Mengganti "day" dengan nama hari
                $jadwal->day = $namaHari;
            }
            
            $dataDokter->jadwal = $jadwalDokter;

            return response(
                [
                    'message'   => "Berhasil Mengambil data Dokter",
                    'data'      => $dataDokter,
                ], 
                Response::HTTP_OK
            );
        }catch(Exception $e){
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

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
            'ttl' => 'required',
            'alamat_praktek' => 'required',
            'no_rek' => 'required',
            'tgl_rek' => 'required',
            'masa_berlaku' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            $fotoName = $request->file('foto')->store('public/img_dokter');
            $input['foto'] = $fotoName;
        }

        Dokter::create($input);
        return response()->json(['message' => 'Data berhasil ditambah']);
    }

    public function destroy($id)
    {
        Dokter::destroy($id);
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
