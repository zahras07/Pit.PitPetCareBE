<?php

namespace App\Http\Controllers\Api;

use App\Models\Pelanggan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    
    // public function response($user)
    // {
    //     $token = $user->createToken( str()->random(40) )->plainTextToken;

    //     return response()->json([
    //         'user' => $user,
    //         'token' => $token,
    //         'token_type' => 'Bearer',
    //     ]);
    // }
    
    public function register(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4',
            ]);
    
            $user = User::create([
                'name' => ucwords($request->name),
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    
            $user->role ='Pelanggan';
            $user->save();

            //create pelanggan


            $pelanggan = Pelanggan::create(
                [
                    'user_id' => $user->id,
                    'nama_pelanggan' => $user->name,
                ]
            );
            $pelanggan->save();


            return response(
                [
                    'message'   => "Berhasil Melakukan Pendaftaran",
                    'data'      => $user,
                ], 
                Response::HTTP_OK
            );
        }catch (ValidationException $e) {
            // Tangani kesalahan validasi
            return response(
                [
                    'message'   => $e->getMessage(),
                    'data'      => null,
                ], 
                Response::HTTP_UNPROCESSABLE_ENTITY
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

    //fungsi untuk login pengguna atau admin
    public function login(Request $request)
    {
       try{
        $credentials = $request->only('email', 'password');
        
        if (!$token = JWTAuth::attempt($credentials)) {
            return response(
                [
                    'message'   => "Email atau Password salah",
                    'token'      => null,
                    'user'      => null,
                ], 
                Response::HTTP_UNAUTHORIZED
            );
        }

         // Dapatkan data user yang berhasil login
         $user = Auth::user();

         if($user->role=="Admin"){
            return response(
                [
                    'message'   => "Login tidak dapat dilakukan",
                    'token'      => null,
                    'user'      => null,
                ], 
                Response::HTTP_UNAUTHORIZED
            );
         }

         $user->pelanggan = DB::table('pelanggans')->where('user_id', $user->id)->first();

         return response()->json(['token' => $token, 'user' => $user], Response::HTTP_OK);

        }catch (ValidationException $e) {
            // Tangani kesalahan validasi
            return response(
                [
                    'message'   => $e->getMessage(),
                    'token'      => null,
                    'user'      => null,
                ], 
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }catch(Exception $e){
            // Tangani kesalahan umum
            return response(
                [
                    'message'   => $e->getMessage(),
                    'token'      => null,
                    'user'      => null,
                ], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function logout()
    {
        try{
            // Mendapatkan token yang saat ini digunakan
            $token = JWTAuth::getToken();

            if ($token) {
                JWTAuth::invalidate($token);
                return response()->json(
                    [
                        'message' => 'Logged out successfully'
                    ], Response::HTTP_OK);
            }

            return response()->json(
                [
                    'message' => 'Authentikasi tidak valid',
                    
                ], Response::HTTP_NOT_FOUND);
        }catch(Exception $e){
            // Tangani kesalahan umum
            return response(
                [
                    'message'   => $e->getMessage(),
                   
                ], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}