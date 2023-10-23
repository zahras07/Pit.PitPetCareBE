<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Models\Paket;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all('*');
        $layanans = Layanan::all('*');

        return view('paket.index', [
            'pakets' => $pakets,
            'layanans' => $layanans,
        ]);
    }

    public function create()
    {
          return view('paket.create',[
            'layanans' => Layanan::all('*')
        ]);

    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'layanan_id' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);
        Paket::create($validatedData);
        return redirect('/paket')->with('pesan', 'Data berhasil ditambah');
    }

    public function show(Paket $paket)
    {
    }
    public function edit(Request $request, $id)
    {
        return view('paket.edit', [
            'layanans' => Layanan::all(('*')),
            'paket' => Paket::find($id)
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'layanan_id' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        Paket::where('id', $id)->update($validatedData);

        return redirect('/paket')->with('pesan', 'Data berhasil diupdate');
    }

    public function destroy(Request $request, $id)
    {
        //
        paket::destroy($id);
        return redirect('/paket')->with('pesan','Data berhasil dihapus');
    }
}