@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Data Dokter</h6>
                    </div>
                    <div class="card-header pb-0">
                        <a href="/dokter/create" class="btn btn-outline-danger">Insert</a>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Nama</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bold">Foto</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Tempat, Tanggal
                                        Lahir</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Alamat Praktek</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">No Rekomendasi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Tanggal Rekomendasi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Foto Sertifikat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Masa Berlaku</th>
                                </thead>
                                <tbody>

                                    @forelse($dokters as $dokter)
                                        <tr class="align-middle text-center text-sm text-xs font-weight-bold mb-0">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dokter->nama_dokter }}</td>
											<td ><img src="{{ asset('profil/' . $dokter->foto) }}" style="height: 70px; width: 70px;">                                            </td>
                                            <td>{{ $dokter->ttl }}</td>
                                            <td>{{ $dokter->alamat_praktek }}</td>
                                            <td>{{ $dokter->no_rek }}</td>
                                            <td>{{ $dokter->tgl_rek }}</td>
                                            <td ><img src="{{ asset('sertifikat/' . $dokter->certificate_photo) }}" style="height: 70px; width: 70px;"> 
                                            <td>{{ $dokter->masa_berlaku }}</td>
                                            <td><a href="/dokter/{{ $dokter->id }}/edit" class="btn btn-warning">Edit</a>
												<form action="/dokter/{{$dokter->id}}" method="post" class="d-inline">
													@method('DELETE')
													@csrf
													<button class="btn btn-danger" type="submit" onclick="return confirm('Yakin akan menghapus data ?')">Delete</button>
												</form>		
                                            </td>
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
