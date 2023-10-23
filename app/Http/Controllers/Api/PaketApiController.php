<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PaketApiController extends Controller
{
    public function index($paket_id)
    {
        try {
           
            $data = DB::table('pakets')->where('layanan_id', $paket_id)->where('status', 'tersedia')->get();
        
            return response(
                [
                    'message'   => "Berhasil Mengambil data Paket",
                    'data'      => $data,
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

    public function allPackageService()
    {
        try {
           
            $data = DB::table('pakets')->get();
        
            return response(
                [
                    'message'   => "Berhasil Mengambil data Paket",
                    'data'      => $data,
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
