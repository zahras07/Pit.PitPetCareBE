@extends('layouts.app')

@section('contents')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="card-header pb-0">
                        <h6>Edit Data Jadwal Dokter</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/jadwaldokter/{{ $jadwaldokter->id_jadwal }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Nama Dokter</label>
                                            <select class="form-select" id="id_dokter" name="id_dokter">
                                                @foreach ($dokters as $dokter)
                                                <option value="{{ $dokter->id }}" @if($dokter->id === $jadwaldokter->id_dokter) selected @endif>{{ $dokter->nama_dokter }}</option>
                                                @endforeach
                                            </select>
                                    </div>
            
                                    <div class="mb-3">
                                        <label for="day" class="form-label">Hari</label>
                                        <input type="number" class="form-control" id="day" name="day" value="{{ $jadwaldokter->day }}">
                                        @error('day')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $jadwaldokter->jam_mulai }}">
                                        @error('jam_mulai')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ $jadwaldokter->jam_selesai }}">
                                        @error('jam_selesai')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $jadwaldokter->keterangan }}">
                                        @error('keterangan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="aktif" {{ $jadwaldokter->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="tidak_aktif" {{ $jadwaldokter->status == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
    
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
</div>
@endsection
