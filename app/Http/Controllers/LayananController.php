<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        return view('layanan.index',[
            'layanans' =>  Layanan::paginate(7)

        ]);
    }

    public function create()
    {
          return view('layanan.create',[
            'layanans' => Layanan::all('*')
        ]);

    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'nama_layanan' => 'required',
        ]);
        Layanan::create($validatedData);
        return redirect('/layanan')->with('pesan', 'Data berhasil ditambah');
    }

    public function show(layanan $layanan)
    {
    }
    public function edit(Request $request, $id)
    {
        return view('layanan.edit', [
            'layanan' => Layanan::find($id)
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_layanan' => 'required',
        ]);

        Layanan::where('id', $id)->update($validatedData);

        return redirect('/layanan')->with('pesan', 'Data berhasil diupdate');
    }

    public function destroy(Request $request, $id)
    {
        //
        Layanan::destroy($id);
        return redirect('/layanan')->with('pesan','Data berhasil dihapus');
    }
}
