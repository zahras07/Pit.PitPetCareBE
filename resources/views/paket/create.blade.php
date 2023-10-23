@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Tambah Data Paket</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/paket" method="post">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label"><b>Nama Layanan</b></label>
                                            <div class="col-sm-14">
                                                <select name="layanan_id" class="form-select">
                                                    <option value ="" selected>Nama Layanan</option>
                                                    @foreach ($layanans as $data)
                                                        <option value="{{ $data->id }}">{{ $data->nama_layanan}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('layanan_id')
                                                {{ $message }}
                                            @enderror
                                       

                                        <div class="mb-3">
                                            <label class="form-label">Nama paket</label>
                                            <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                                                value="{{ old('nama_paket') }}">
                                        </div>
                                        @error('nama_paket')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Harga</label>
                                            <input type="text" class="form-control" id="harga" name="harga"
                                                value="{{ old('harga') }}">
                                        </div>
                                        @error('harga')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Deksripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                                value="{{ old('deskripsi') }}">
                                        </div>
                                        @error('deskripsi')
                                            {{ $message }}
                                        @enderror

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="tersedia" @if (old('status') == 'tersedia') selected @endif>Tersedia</option>
                                                <option value="tidak tersedia" @if (old('status') == 'tidak tersedia') selected @endif>Tidak Tersedia</option>
                                            </select>
                                        </div>
                                        @error('status')
                                        {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-info">Tambahkan Data</button>
                                        </div>
                                    </form>
                                </div>
                            @endsection
