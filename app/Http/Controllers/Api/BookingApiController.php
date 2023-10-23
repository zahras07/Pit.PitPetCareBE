<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use stdClass;

class BookingApiController extends Controller
{
    public function index()
    {
        try {
           
            $pelanggan = DB::table('pelanggans')->where('user_id', auth()->user()->id)->first();

            $transaction = DB::table('transaksis')->where('pelanggan_id', $pelanggan->id)->get();

            $arrayBooking = array();

            foreach($transaction as $data){

                $objectBooking = new stdClass();
                $objectBooking->id = $data->id;
                $objectBooking->pelanggan = DB::table('pelanggans')->where('id', $data->pelanggan_id)->first();
                $objectBooking->hewan = DB::table('hewans')->where('id', $data->hewan_id)->first();
                $objectBooking->layanan = DB::table('layanans')->where('id', $data->layanan_id)->first();
                $objectBooking->paket = DB::table('pakets')->where('id', $data->paket_id)->first();
                $objectBooking->dokter = DB::table('dokters')->where('id', $data->dokter_id)->first();
                // Membuat objek DateTime dari string tanggal
                $date = date_create($data->tgl_transaksi);

                if ($date !== false) {
                    // Mengubah format tanggal ke "d F Y" (04 October 2023)
                    $objectBooking->tgl_transaksi = date_format($date, 'd F Y');
                }
                
                $objectBooking->total = $data->total;
                $objectBooking->nomor_antrian = $data->nomor_antrian;
                $objectBooking->status = $data->status;

                $arrayBooking[] = $objectBooking;
            }
        
            return response(
                [
                    'message'   => "Berhasil Mengambil data Transaksi",
                    'data'      => $arrayBooking,
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


    public function booking(Request $request)
    {
        try {

            
            $status = "proses"; //

            $dataTransaksi = DB::table('transaksis')->where('status', 'proses')->where('layanan_id', $request->input('layanan_id'))->where('tgl_transaksi', $request->input('booking_date'))->count();

            
            if($dataTransaksi>3){
                return response(
                    [
                        'message'   => "Kuota grooming sudah penuh",
                        'data'      => null,
                    ], 
                    Response::HTTP_BAD_REQUEST
                );
            }else{

                

                if($request->input('layanan_id')==1){
                    // Mengonversi tanggal string ke dalam format timestamp
                    $timestamp = strtotime($request->input('booking_date'));

                    // Menggunakan date() untuk mendapatkan nomor hari (0 untuk Minggu, 1 untuk Senin, dst.)
                    $nomor_hari = date("w", $timestamp);

                    $jadwalDokter = DB::table('jadwal_dokter')->where('id_dokter', $request->input('dokter_id'))->where('day', $nomor_hari)->first();

                   

                    if($jadwalDokter==null){
                        return response(
                            [
                                'message'   => "Tidak dapat melakukan booking, Silahkan pilih dokter lain",
                                'data'      => null,
                            ], 
                            Response::HTTP_BAD_REQUEST
                        );
                    }
                }

                // Membuat objek DateTime dari string tanggal
                $bookingDate = date_create($request->input('booking_date'));

                if ($bookingDate !== false) {
                    // Mengubah format tanggal ke "Y-m-d" (2023-10-04)
                    $bookingDate = date_format($bookingDate, 'Y-m-d');
                } else {
                    return response(
                        [
                            'message'   => "Format tanggal tidak valid.",
                            'data'      => null,
                        ], 
                        Response::HTTP_BAD_REQUEST
                    );
                }


                $transaksi = new Transaksi();
                $transaksi->dokter_id = $request->input('dokter_id');
                $transaksi->pelanggan_id = $request->input('pelanggan_id');
                $transaksi->hewan_id = $request->input('hewan_id');
                $transaksi->layanan_id = $request->input('layanan_id');
                $transaksi->paket_id = $request->input('paket_id');
                $transaksi->tgl_transaksi = $bookingDate;
                $transaksi->jam_antar = $request->input('delivery_time');
                $transaksi->jam_jemput = $request->input('pickup_time');
                $transaksi->nomor_antrian = $this->generate_antrian_number($request->input('booking_date'));

                $tanggal_format = date("Y-m-d", strtotime($request->input('booking_date'))) . $request->input('delivery_time');
                $datetime = new DateTime($tanggal_format);
                $datetime->modify('+1 day');
               
                $transaksi->deadline = $datetime->format('Y-m-d H:i:s');
                $transaksi->total = $request->input('total');
    
    
                $paket = DB::table('pakets')->where('id', $request->input('paket_id'))->first();
    
                //jika terjadi perubahan harga paket, maka harga terbaru yang akan digunakan
                if($paket->harga!=$request->input('total')){
                    $transaksi->total = $paket->harga;
                }
                $transaksi->save();
            
                return response(
                    [
                        'message'   => "Berhasil Melakukan Booking",
                        'data'      => $transaksi,
                    ], 
                    Response::HTTP_OK
                );
            }
           
            
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

    public function generate_antrian_number($bookingDate)
    {
        $query = DB::table('transaksis')
            ->where('tgl_transaksi',$bookingDate)
            ->max('nomor_antrian');

        $nomor_antrian = $query ? $query + 1 : 1;

        return $nomor_antrian;
    }

    public function cancelBooking($transactionId) {
        try {

            $transaksi = Transaksi::find($transactionId);
            
            if($transaksi->status != "belum dikonfirmasi"){
                return response(
                    [
                        'message'   =>"Tidak dapat membatalkan booking yang sedang diproses",
                        'data'      => null,
                    ], 
                    Response::HTTP_BAD_REQUEST
                );
            }
           
            $transaksi = Transaksi::find($transactionId);
            $transaksi->status = "dibatalkan";
            $transaksi->save();
        
            return response(
                [
                    'message'   => "Berhasil Membatalkan Booking",
                    'data'      => $transaksi,
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
