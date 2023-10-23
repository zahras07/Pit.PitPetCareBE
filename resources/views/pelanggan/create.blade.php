@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Tambah Data Pelanggan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/pelanggan" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label for="nama_pelanggan">Id User</label>
                                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ old('user_id') }}">
                                            @error('user_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="nama_pelanggan">Nama Pelanggan</label>
                                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}">
                                            @error('nama_pelanggan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                                            @error('alamat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon') }}">
                                            @error('telepon')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <div class="mb-3">
                                            <label for="foto">Foto</label>
                                            <input type="file" class="form-control" name="foto" accept="image/*">
                                        </div>
                                        @error('foto')
                                            {{ $message }}
                                        @enderror


                                        <div class="mb-3">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-info">Tambahkan Data</button>
                                        </div>
                                    </form>
                                </div>
                            @endsection
