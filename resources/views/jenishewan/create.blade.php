@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Tambah Data Jenis Hewan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/jenishewan" method="post">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">Jenis Hewan</label>
                                            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                                                value="{{ old('nama_jenis') }}">
                                        </div>
                                        @error('nama_jenis')
                                            {{ $message }}
                                        @enderror
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                                value="{{ old('deskripsi') }}">
                                        </div>
                                        @error('deskripsi')
                                            {{ $message }}
                                        @enderror
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
