@extends('layouts.app')
@section('contents')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
      <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Layanan</h6>
  </nav>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Edit Data Jenis Hewan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/jenishewan/{{ $jenis_hewan->id }}" method="post">
                                        @method('PUT')
                                        @csrf

                                        <div class="mb-3">
                                            <label for="nama_jenis" class="form-label">Nama Jenis</label>
                                            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" value="{{ $jenisHewan->nama_jenis }}">
                                            @error('nama_jenis')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
        
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $jenisHewan->deskripsi }}</textarea>
                                            @error('deskripsi')
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
