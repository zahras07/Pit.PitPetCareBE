@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-header pb-0">
                            <h6>Tambah Data Transaksi</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/transaksi" method="post">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label"><b>Nama Pelanggan</b></label>
                                            <div class="col-sm-14">
                                                <select name="pelanggan_id" class="form-select">
                                                    <option value="" selected>Nama Pelanggan</option>
                                                    @foreach ($pelanggans as $pelanggan)
                                                        <option value="{{ $pelanggan->id }}">
                                                            {{ $pelanggan->nama_pelanggan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('pelanggan_id')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><b>Nama Hewan</b></label>
                                            <div class="col-sm-14">
                                                <select name="hewan_id" class="form-select">
                                                    <option value="" selected>Nama Hewan</option>
                                                    @foreach ($hewans as $hewan)
                                                        <option value="{{ $hewan->id }}">{{ $hewan->nama_hewan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('hewan_id')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><b>Nama Layanan</b></label>
                                            <div class="col-sm-14">
                                                <select name="layanan_id" class="form-select">
                                                    <option value="" selected>Nama Layanan</option>
                                                    @foreach ($layanans as $layanan)
                                                        <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('layanan_id')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><b>Nama Paket</b></label>
                                            <div class="col-sm-14">
                                                <select name="paket_id" class="form-select">
                                                    <option value="" selected>Nama Paket</option>
                                                    @foreach ($pakets as $paket)
                                                        <option value="{{ $paket->id }}">{{ $paket->nama_paket }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('paket_id')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Dokter</label>
                                            <div class="col-sm-14">
                                                <select name="dokter_id" class="form-select">
                                                    <option value="" selected>Pilih Dokter</option>
                                                    @foreach ($dokters as $dokter)
                                                        <option value="{{ $dokter->id }}">{{ $dokter->nama_dokter }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('dokter_id')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Transaksi:</label>
                                            <input type="date" class="form-control" name="tgl_transaksi"
                                                value="{{ old('tgl_transaksi') }}">
                                        </div>
                                        @error('tgl_transaksi')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Jam Antar:</label>
                                            <input type="time" class="form-control" name="jam_antar"
                                                value="{{ old('jam_antar') }}">
                                        </div>
                                        @error('jam_antar')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Jam Jemput:</label>
                                            <input type="time" class="form-control" name="jam_jemput"
                                                value="{{ old('jam_jemput') }}">
                                        </div>
                                        @error('jam_jemput')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Total:</label>
                                            <input type="text" class="form-control" id="total" name="total"
                                                value="{{ old('total') }}">
                                        </div>
                                        @error('total')
                                            {{ $message }}
                                        @enderror

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="belum dikonfirmasi"
                                                    @if (old('status') == 'belum dikonfirmasi') selected @endif>Belum Dikonfirmasi
                                                </option>
                                                <option value="proses" @if (old('status') == 'proses') selected @endif>
                                                    Proses</option>
                                                <option value="selesai" @if (old('status') == 'selesai') selected @endif>
                                                    Selesai</option>
                                                <!-- Tambahkan pilihan lain sesuai dengan kolom 'status' -->
                                            </select>
                                        </div>
                                        @error('status')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Nomor Antrian:</label>
                                            <input type="number" class="form-control" id="nomor_antrian"
                                                name="nomor_antrian" value="{{ old('nomor_antrian') }}">
                                        </div>
                                        @error('nomor_antrian')
                                            {{ $message }}
                                        @enderror

                                        <div class="mb-3">
                                            <label class="form-label">Deadline:</label>
                                            <input type="datetime-local" class="form-control" id="deadline" name="deadline"
                                                value="{{ old('deadline') }}">
                                        </div>
                                        @error('deadline')
                                            {{ $message }}
                                        @enderror
                                        <div class="mb-3">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-info">Tambahkan Data</button>
                                        </div>
                                    </form>
                                </div>
                            @endsection
