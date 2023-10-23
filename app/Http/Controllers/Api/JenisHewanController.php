<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Hewan;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    public function index()
    {
        try {
            $jenisHewan= DB::table('jenis_hewan')->get();
    
            return response(
                [
                    'message'   => "Berhasil Mengambil data Jenis Hewan",
                    'data'      => $jenisHewan,
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
