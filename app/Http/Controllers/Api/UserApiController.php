<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Pelanggan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserApiController extends Controller
{
    public function changePhotoProfileCustomer(Request $request, $pelangganId)
    {
        try {
           
            if($foto= $request->file('foto')){
                $destinationPath = 'img_pelanggan/';
                $profileImage= date('YmdHis') ."." . $foto->getClientOriginalExtension();
                $foto->move($destinationPath, $profileImage);

                $pelanggan = Pelanggan::find($pelangganId);
                $pelanggan->foto = $destinationPath . $profileImage;
                $pelanggan->save();

                return response(
                    [
                        'message'   => "Berhasil mengubah foto profil",
                        'data'      =>  null,
                    ], 
                    Response::HTTP_OK
                );
            }
            return response(
                [
                    'message'   => "Gagal mengubah foto profil",
                    'data'      => null,
                ], 
                Response::HTTP_BAD_REQUEST
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

    public function updateDataPelanggan(Request $request, $pelangganId) {
        try {
            //mengubah data pelanggan
            $dataPelanggan = Pelanggan::find($pelangganId);
            $dataPelanggan->nama_pelanggan = $request->input('nama_pelanggan');
            $dataPelanggan->alamat = $request->input('alamat');
            $dataPelanggan->telepon = $request->input('telepon');
            $dataPelanggan->save();

            //update nama pengguna di data user
            $user = User::find(auth()->user()->id);
            $user->name = $request->input('nama_pelanggan');
            $user->save();
        
            return response(
                [
                    'message'   => "Berhasil Mengubah Data",
                    'data'      => null,
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

    public function changePassword(Request $request) {
        try {
            
            // Validasi input


            $user = User::find(auth()->user()->id);

            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);

            // Memeriksa kata sandi saat ini
            if (!password_verify($request->input('current_password'), $user->password)) {
                return response(
                    [
                        'message'   => 'Kata sandi saat ini salah',
                        'data'      => null,
                    ], 
                    Response::HTTP_BAD_REQUEST
                );
               
            }

            // Mengganti kata sandi pengguna
            $user->password = bcrypt($request->input('new_password'));
            $user->save();

        
            return response(
                [
                    'message'   => "Berhasil Mengubah Kata Sandi",
                    'data'      => null,
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

    public function changeEmail(Request $request) {
        try {
           
            $user = User::find(auth()->user()->id);

            // Validasi input
            $request->validate([
                'new_email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

             // Memeriksa kata sandi saat ini
            if (!password_verify($request->input('password'), $user->password)) {

                return response(
                    [
                        'message'   => 'Kata sandi saat ini salah',
                        'data'      => null,
                    ], 
                    Response::HTTP_BAD_REQUEST
                );
            }


            // Mengubah alamat email pengguna
            $user->email = $request->input('new_email');
            $user->save();

        
            return response(
                [
                    'message'   => "Berhasil Mengubah Alamat Email",
                    'data'      => null,
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

    //mengambil data user
    public function userData()
    {
        try {
           
            $user = auth()->user();
            if($user->role == "Pelanggan"){
                $user->pelanggan = DB::table('pelanggans')->where('user_id', $user->id)->first();
             }else if($user->role == "Dokter"){
                $user->dokter = DB::table('dokters')->where('user_id', $user->id)->first();
             }
        
            return response(
                [
                    'message'   => "Berhasil Mengambil Data Pengguna",
                    'data'      => $user,
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
