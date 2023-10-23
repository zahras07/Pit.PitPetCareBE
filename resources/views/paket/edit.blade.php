@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Edit Data Paket</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/paket/{{ $paket->id }}" method="post">
                                        @method('PUT')
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">Jenis Layanan</label>
                                                <select class="form-select" id="layanan_id" name="layanan_id">
                                                    @foreach ($layanans as $layanan)
                                                    <option value="{{ $layanan->id }}" @if($layanan->id === $paket->layanan_id) selected @endif>{{ $layanan->nama_layanan }}</option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama paket</label>
                                            <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                                                value="{{ $paket->nama_paket }}">
                                        </div>
                                        @error('nama_paket')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Harga</label>
                                            <input type="text" class="form-control" id="harga" name="harga"
                                                value="{{ $paket->harga }}">
                                        </div>
                                        @error('harga')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                                value="{{ $paket->deskripsi }}">
                                        </div>
                                        @error('deskripsi')
                                            {{ $message }}
                                        @enderror

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="tersedia" @if ($paket->status == 'tersedia') selected @endif>Tersedia</option>
                                                <option value="tidak tersedia" @if ($paket->status == 'tidak tersedia') selected @endif>Tidak Tersedia</option>
                                            </select>
                                        </div>
                                        @error('status')
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
    </div>
@endsection
