<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LayananApiController extends Controller
{
    public function index()
    {
        try {
           
            $data = DB::table('layanans')->get();
        
            return response(
                [
                    'message'   => "Berhasil Mengambil data Layanan",
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
