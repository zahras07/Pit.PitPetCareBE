<?php

namespace App\Http\Controllers;

use App\Models\JenisHewan;
use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\Pelanggan;

class HewanController extends Controller
{
    public function index()
    {
        $hewans = Hewan::all();
        $pelanggans = Pelanggan::all();
        $jenis_hewan = JenisHewan::all();

        return view('hewan.index', [
            'hewans' => $hewans,
            'pelanggans' => $pelanggans,
            'jenishewan' => $jenis_hewan,
        ]);
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $jenis_hewan = JenisHewan::all();

        return view('hewan.create', compact('pelanggan', 'jenis_hewan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pelanggan_id' => 'required',
            'nama_hewan' => 'required',
            'jenis_hewan' => 'required',
            'umur' => 'required|integer',
            'berat' => 'required',
        ]);
        Hewan::create($validatedData);
        return redirect('/hewan')->with('pesan', 'Data berhasil ditambah');
    }

    public function show(Hewan $hewan)
    {
    }

    public function edit(Request $request, $id)
    {
        return view('hewan.edit', [
            'pelanggans' => Pelanggan::all(),
            'hewans' => Hewan::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pelanggan_id' => 'required',
            'nama_hewan' => 'required',
            'jenis_hewan' => 'required',
            'umur' => 'required',
            'berat' => 'required',
        ]);

        Hewan::where('id', $id)->update($validatedData);
        return redirect('/hewan')->with('pesan', 'Data berhasil diupdate');
    }

    public function destroy(Request $request, $id)
    {
        Hewan::destroy($id);
        return redirect('/hewan')->with('pesan', 'Data berhasil dihapus');
    }
}