@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Data Transaksi</h6>
                    </div>
                    <div class="card-header pb-0">
                        <a href="/transaksi/create" class="btn btn-outline-danger">Insert</a>
                    </div>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama Pelanggan</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama Hewan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama Layanan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama Paket</th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama Dokter</th> --}}
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Tanggal Transaksi</th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bold">Jam Antar</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Jam Jemput</th> --}}
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Total</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nomor Antrian</th>
                                </thead>
                                <tbody>

                                    @forelse($transaksis as $transaksi)
                                        <tr class="align-middle text-center text-sm text-xs font-weight-bold mb-0">
                                            <td>{{ $loop ->iteration }}</td>
                                            <td>{{ $transaksi->nama_pelanggan }}</td>
                                            <td>{{ $transaksi->nama_hewan }}</td>
                                            <td>{{ $transaksi->nama_layanan}}</td>
                                            <td>{{ $transaksi->nama_paket }}</td>
                                            {{-- <td>{{ $transaksi->nama_dokter }}</td> --}}
                                            <td>{{ $transaksi->tgl_transaksi }}</td>
                                            {{-- <td>{{ $transaksi->jam_antar }}</td>
                                            <td>{{ $transaksi->jam_jemput }}</td> --}}
                                            <td>{{ $transaksi->total }}</td>
                                            <td>{{ $transaksi->status }}</td>
                                            <td>{{ $transaksi->nomor_antrian }}</td>
                                            <td><a href="/transaksi/{{ $transaksi->id }}/edit" class="btn btn-warning">Edit</a>
												<form action="/transaksi/{{$transaksi->id}}" method="post" class="d-inline">
													@method('DELETE')
													@csrf
													<button class="btn btn-danger" type="submit" onclick="return confirm('Yakin akan menghapus data ?')">Delete</button>
												</form>		
                                            </td>
                                        </tr>

                                    @empty
                                    <td colspan="9" class="text-center text-uppercase text-secondary text-xxs font-weight-bold">Tidak ada data</td>
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
