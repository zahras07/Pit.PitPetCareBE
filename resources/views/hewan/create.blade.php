@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Tambah Data Hewan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/hewan" method="post" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="mb-3">
                                            <label class="form-label"><b>Nama pelanggan-</b></label>
                                            <div class="col-sm-14">
                                                <select name="pelanggan_id" class="form-select">
                                                    <option value ="" selected>Nama Pelanggan</option>
                                                    @foreach ($pelanggan as $data)
                                                        <option value="{{ $data->id }}">{{ $data->nama_pelanggan}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('pelanggan_id')
                                                {{ $message }}
                                            @enderror
            
                                        <div class="mb-3">
                                            <label for="nama_hewan" class="form-label">Nama Hewan</label>
                                            <input type="text" class="form-control" id="nama_hewan" name="nama_hewan"
                                                value="{{ old('nama_hewan') }}">
                                        </div>
                                        @error('nama_hewan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
            
                                        <div class="mb-3">
                                            <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
                                            <select name="jenis_hewan" class="form-select">
                                                @foreach($jenis_hewan as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_jenis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('jenis_hewan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
            
                                        <div class="mb-3">
                                            <label for="umur" class="form-label">Umur</label>
                                            <input type="number" class="form-control" id="umur" name="umur"
                                                value="{{ old('umur') }}">
                                        </div>
                                        @error('umur')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
            
                                        <div class="mb-3">
                                            <label for="berat" class="form-label">Berat</label>
                                            <input type="text" class="form-control" id="berat" name="berat"
                                                value="{{ old('berat') }}">
                                        </div>
                                        @error('berat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
            
                                        <div class="mb-3">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-info">Tambahkan Data</button>
                                        </div>
                                    </form>
                                </div>
                            @endsection
