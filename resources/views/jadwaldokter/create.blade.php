@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Tambah Data Jadwal Dokter</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/jadwaldokter" method="post">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label"><b>Nama Dokter</b></label>
                                            <div class="col-sm-14">
                                                <select name="id_dokter" class="form-select">
                                                    @foreach ($dokters as $data)
                                                        <option value="{{ $data->id }}">{{ $data->nama_dokter}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('id_dokter')
                                                {{ $message }}
                                            @enderror
                                       

                                        <div class="mb-3">
                                            <label class="form-label">Hari</label>
                                            <input type="text" class="form-control" id="day" name="day"
                                                value="{{ old('day') }}">
                                        </div>
                                        @error('day')
                                            {{ $message }}
                                        @enderror
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Jam Mulai</label>
                                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                                value="{{ old('jam_mulai') }}">
                                        </div>
                                        @error('jam_mulai')
                                            {{ $message }}
                                        @enderror
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Jam Selesai</label>
                                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                                value="{{ old('jam_selesai') }}">
                                        </div>
                                        @error('jam_selesai')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                                value="{{ old('keterangan') }}">
                                        </div>
                                        @error('keterangan')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="aktif">Aktif</option>
                                                <option value="tidak_aktif">Tidak Aktif</option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-info">Tambahkan Data</button>
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
