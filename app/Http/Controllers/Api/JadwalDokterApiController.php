<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use stdClass;

class JadwalDokterApiController extends Controller
{
    public function index()
    {
        try {
            $jadwalDokter= DB::table('jadwal_dokter')->where('status', 'aktif')->get();

            $daftarHari = array(
                1 => "Senin",
                2 => "Selasa",
                3 => "Rabu",
                4 => "Kamis",
                5 => "Jumat",
                6 => "Sabtu",
                7 => "Minggu"
            );

            

            // Menggunakan foreach untuk iterasi melalui daftar key dan value

            $resultSchedule = [];
            foreach ($daftarHari as $hariAngka => $namaHari) {
                $resultJadwalDokter = [];
                foreach($jadwalDokter as $data){
                    if($data->day==$hariAngka){
                        $objJadwalDokter = new stdClass();
                        $objJadwalDokter->id_jadwal = $data->id_jadwal;
                        $objJadwalDokter->day = $data->day;
                        $objJadwalDokter->jam_mulai = $data->jam_mulai;
                        $objJadwalDokter->jam_selesai = $data->jam_selesai;
                        $objJadwalDokter->keterangan = $data->keterangan;
                        $objJadwalDokter->status = $data->status;
                        $objJadwalDokter->dokter = DB::table('dokters')->where('id', $data->id_dokter)->first();
        
                        $resultJadwalDokter[] = $objJadwalDokter;
                    }
                }

                $objSchedule = new stdClass();
                $objSchedule->id = $hariAngka;
                $objSchedule->name = $namaHari;
                $objSchedule->schedule_doctor = $resultJadwalDokter;

                $resultSchedule[] = $objSchedule;
            }

            
            
    
            return response(
                [
                    'message'   => "Berhasil Mengambil Jadwal Dokter",
                    'data'      => $resultSchedule,
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
