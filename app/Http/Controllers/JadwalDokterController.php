<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $jadwal_dokter = JadwalDokter::all('*');
        $dokters = Dokter::all('*');

        return view('jadwaldokter.index', [
            'jadwaldokter' => $jadwal_dokter,
            'dokters' => $dokters,
        ]);
    }

    public function create()
    {
        return view('jadwaldokter.create',[
            'dokters' => Dokter::all('*')
        ]);

    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'id_dokter' => 'required',
            'day' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan' => 'nullable',
            'status' => 'required|in:aktif,tidak aktif',
        ]);
        JadwalDokter::create($validatedData);
        return redirect('/jadwaldokter')->with('pesan', 'Data berhasil ditambah');
    }

    public function show(Request $request)
    {
    }
    public function edit(Request $request, $id_jadwal)
    {
        $dokters = Dokter::all('*'); // Mendapatkan data dokter
        return view('jadwaldokter.edit', [
            'jadwaldokter' => JadwalDokter::find($id_jadwal),
            'dokters' => $dokters, // Mengirimkan data dokter ke view
        ]);
    }
    

    public function update(Request $request, $id_jadwal)
    {
        $validatedData = $request->validate([
            'id_dokter' => 'required',
            'day' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);

        JadwalDokter::where('id_jadwal', $id_jadwal)->update($validatedData);

        return redirect('/jadwaldokter')->with('pesan', 'Data berhasil diupdate');
    }

    public function destroy(Request $request, $id_jadwal)
    {
        //
        JadwalDokter::destroy($id_jadwal);
        return redirect('/jadwaldokter')->with('pesan','Data berhasil dihapus');
    }
}
