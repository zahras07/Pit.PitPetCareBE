@extends('layouts.app')
@section('contents')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit Data Dokter</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="/dokter/{{ $dokter->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Nama Dokter</label>
                                    <input type="text" class="form-control" id="nama_dokter" name="nama_dokter"
                                        value="{{ $dokter->nama_dokter }}">
                                </div>
                                @error('nama_dokter')
                                    {{ $message }}
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                                @error('foto')
                                    {{ $message }}
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">Tempat, Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="ttl" name="ttl"
                                        value="{{ $dokter->ttl }}">
                                </div>
                                @error('ttl')
                                    {{ $message }}
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">Alamat Praktek</label>
                                    <input type="text" class="form-control" id="alamat_praktek"
                                        name="alamat_praktek" value="{{ $dokter->alamat_praktek }}">
                                </div>
                                @error('alamat_praktek')
                                    {{ $message }}
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">No Rekomendasi</label>
                                    <input type="text" class="form-control" id="no_rek" name="no_rek"
                                        value="{{ $dokter->no_rek }}">
                                </div>
                                @error('no_rek')
                                    {{ $message }}
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Rekomendasi</label>
                                    <input type="text" class="form-control" id="tgl_rek" name="tgl_rek"
                                        value="{{ $dokter->tgl_rek }}">
                                </div>
                                @error('tgl_rek')
                                    {{ $message }}
                                @enderror

                                <div class="mb-3">
                                    <label for="certificate_photo">Sertifikat</label>
                                    <input type="file" class="form-control" name="certificate_photo" accept="image/*">
                                </div>
                                @error('certificate_photo')
                                    {{ $message }}
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">Masa Berlaku</label>
                                    <input type="text" class="form-control" id="masa_berlaku" name="masa_berlaku"
                                        value="{{ $dokter->masa_berlaku }}">
                                </div>
                                @error('masa_berlaku')
                                    {{ $message }}
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-info">Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
