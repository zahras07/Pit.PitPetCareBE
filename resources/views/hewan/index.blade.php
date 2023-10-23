@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Data Hewan</h6>
                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama Hewan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama Pemilik</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bold">Jenis Hewan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Umur</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Berat</th>
                                </thead>
                                <tbody>

                                    @forelse($hewans as $hewan)
                                        <tr class="align-middle text-center text-sm text-xs font-weight-bold mb-0">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $hewan->nama_hewan}}</td>
                                            <td>{{ $hewan->pelanggan->nama_pelanggan}}</td>
                                            <td>{{ $hewan->jenishewan->nama_jenis }}</td>
											<td>{{ $hewan->umur }}hari</td>
                                            <td>{{ $hewan->berat }}kg</td>
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
