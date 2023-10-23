@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Edit Data layanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/layanan/{{ $layanan->id }}" method="post">
                                        @method('PUT')
                                        @csrf

                                <div class="mb-3">
                                    <label class="form-label">Nama Layanan</label>
                                    <input type="text" class="form-control" id="nama_layanan" name="nama_layanan"
                                        value="{{ $layanan->nama_layanan }}">
                                </div>
                                @error('nama_layanan')
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
