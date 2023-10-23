<?php

namespace App\Http\Controllers;

use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        return view('jenishewan.index',[
            'jenis_hewan' =>  JenisHewan::paginate(7)

        ]);
    }

    public function create()
    {
          return view('jenishewan.create',[
            'jenis_hewan' => JenisHewan::all('*')
        ]);

    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'nama_jenis' => 'required',
            'deskripsi' => 'required',
        ]);
        JenisHewan::create($validatedData);
        return redirect('/jenishewan')->with('pesan', 'Data berhasil ditambah');
    }

    public function show(jenishewan $jenishewan)
    {
    }
    public function edit($id)
    {
        $jenisHewan = JenisHewan::find($id);

        return view('jenishewan.edit', compact('jenishewan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_jenis' => 'required',
            'deskripsi' => 'required',
        ]);

        JenisHewan::where('id', $id)->update($validatedData);

        return redirect('/jenis-hewan')->with('pesan', 'Data berhasil diupdate');
    }

    public function destroy(Request $request, $id_jenis_hewan)
    {
        //
        jenishewan::destroy($id_jenis_hewan);
        return redirect('/jenishewan')->with('pesan','Data berhasil dihapus');
    }
}
