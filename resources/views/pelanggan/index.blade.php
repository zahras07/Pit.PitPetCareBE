@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Data Pelanggan</h6>
                    </div>
                    <div class="card-header pb-0">
                        <a href="/pelanggan/create" class="btn btn-outline-danger">Insert</a>
                    </div>
                    @if (session()->has('pesan'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{ session('pesan') }}
                        </div>
                    @endif
                    @if (session()->has('pesan'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{ session('pesan') }}
                        </div>
                    @endif
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Foto</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Alamat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Telepon</th>
                                    
                                </thead>
                                <tbody>

                                    @forelse($pelanggans as $pelanggan)
                                    <tr class="align-middle text-center text-sm text-xs font-weight-bold mb-0">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pelanggan->nama_pelanggan }}</td>
                                            <td ><img src="{{ asset('img_pelanggan/' . $pelanggan->foto) }}" style="height: 70px; width: 70px;">     
                                            <td>{{ $pelanggan->alamat }}</td>
                                            <td>{{ $pelanggan->telepon }}</td>
                                           
                                        </tr>
                                    @empty
                                    <td colspan="6" class="text-center text-uppercase text-secondary text-xxs font-weight-bold">Tidak ada data</td>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
