<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('user')->paginate(5);

        return view('pelanggan.index', [
            'pelanggans' => $pelanggans,
        ]);
    }

    public function create()
    {
        return view('pelanggan.create', [
            'pelanggans' => Pelanggan::all(),
            'users' => User::all()
        ]);

        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'=>'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        $input = $request->all();
    
        if($foto= $request->file('foto')){
            $destinationPath = 'img_pelanggan/';
            $profileImage= date('YmdHis') ."." . $foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        }
    
        Pelanggan::create($input);
        return redirect('/pelanggan')->with('pesan', 'Data berhasil ditambah');
    }

    public function show(pelanggan $pelanggan,$id)
    {
        $pelanggan = Pelanggan::with('user')->find($id);

        if (!$pelanggan) {
            return redirect('/pelanggan')->with('error', 'Data pelanggan tidak ditemukan');
        }
    
        return view('pelanggan.show', [
            'pelanggans' => $pelanggan,
        ]);

    }
    
    public function edit(Pelanggan $pelanggan, $id)
    {
        return view('dashboard.edit',[
            'users' => User::all(),
            'pelanggans' => Pelanggan::find($id)
        ]);
    }

    // public function update(Request $request, $id_pelanggan)
    // {
    //     $validatedData = $request->validate([
    //         'nama_pelanggan' => 'required',
    //         'alamat' => 'required',
    //         'telepon' => 'required',
    //         'foto' => 'required',
    //     ]);

    //     Pelanggan::where('id_pelanggan', $id_pelanggan)->update($validatedData);

    //     return redirect('/pelanggan')->with('pesan', 'Data berhasil diupdate');
    // }

    public function destroy($id)
    {
        Pelanggan::where('id', $id)->delete();

        return redirect('/pelanggan')->with('pesan', 'Data berhasil dihapus');
    }
}