<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        return view('dokter.index',[
            'dokters' =>  Dokter::paginate(7)

        ]);
    }

    public function create()
    {
        return view('dokter.create');

    }

    public function store(Request $request)
    {
    $request->validate([
        'nama_dokter' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        'ttl' => 'required',
        'alamat_praktek' => 'required',
        'no_rek' => 'required',
        'tgl_rek' => 'required',
        'certificate_photo' => 'required|image|mimes:jpeg,png,jpg,gif',
        'masa_berlaku' => 'required',
    ]);

    $input = $request->all();

    
    if($foto= $request->file('foto')){
        $destinationPath = 'profil/';
        $profileImage= date('YmdHis') ."." . $foto->getClientOriginalExtension();
        $foto->move($destinationPath, $profileImage);
        $input['foto'] = "$profileImage";
    }

    if($certificate_photo= $request->file('certificate_photo')){
        $destinationPath = 'sertifikat/';
        $profileImage= date('YmdHis') ."." . $certificate_photo->getClientOriginalExtension();
        $certificate_photo->move($destinationPath, $profileImage);
        $input['certificate_photo'] = "$profileImage";
    }

    Dokter::create($input);
    return redirect('dokter')->with('pesan', 'Data berhasil ditambah');
    }

    public function show(Dokter $dokter)
    {
    }

    public function edit($id)
    {
        return view('dokter.edit', [
            'dokter' => Dokter::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'ttl' => 'required',
            'alamat_praktek' => 'required',
            'no_rek' => 'required',
            'tgl_rek' => 'required',
            'masa_berlaku' => 'required',
        ]);
    
        // Find the Dokter model instance by its ID
        $dokter = Dokter::findOrFail($id);
    
        // Get all input data
        $input = $request->all();
    
        // Handle the 'foto' image file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $destinationPath = 'profil/';
            $profileImage = date('YmdHis') . "." . $foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profileImage);
            $input['foto'] = $profileImage;
    
            // Delete the old 'foto' file if it exists
            if ($dokter->foto && file_exists(public_path('profil/' . $dokter->foto))) {
                unlink(public_path('profil/' . $dokter->foto));
            }
        }
    
        // Handle the 'certificate_photo' image file upload
        if ($request->hasFile('certificate_photo')) {
            $certificate_photo = $request->file('certificate_photo');
            $destinationPath = 'sertifikat/';
            $profileImage = date('YmdHis') . "." . $certificate_photo->getClientOriginalExtension();
            $certificate_photo->move($destinationPath, $profileImage);
            $input['certificate_photo'] = $profileImage;
    
            // Delete the old 'certificate_photo' file if it exists
            if ($dokter->certificate_photo && file_exists(public_path('sertifikat/' . $dokter->certificate_photo))) {
                unlink(public_path('sertifikat/' . $dokter->certificate_photo));
            }
        }
    
        // Update the Dokter model with the validated and uploaded data
        $dokter->update($input);
    
        return redirect('dokter')->with('pesan', 'Data berhasil diupdate');
    }
    


    public function destroy(Request $request, $id)
    {
        Dokter::destroy($id);
        return redirect('/dokter')->with('pesan', 'Data berhasil dihapus');
    }
}
