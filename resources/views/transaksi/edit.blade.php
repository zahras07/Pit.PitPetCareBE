@extends('layouts.app')
@section('contents')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
      <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Transaksi</h6>
  </nav>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Edit Data Transaksi</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/transaksi/{{ $transaksi->id }}" method="post">
                                        @method('put')
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">Jam Jemput</label>
                                            <input type="text" class="form-control" id="jam_jemput" name="jam_jemput"
                                                value="{{ $transaksi->jam_jemput }}">
                                        </div>
                                        @error('jam_jemput')
                                            {{ $message }}
                                        @enderror

                                        <div class="form-group">
                                            <label for="status">Status </label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="belum dikonfirmasi" {{ $transaksi->status == 'belum dikonfirmasi' ? 'selected' : '' }}>Belum Dikonfirmasi</option>
                                                <option value="proses" {{ $transaksi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
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
