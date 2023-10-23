@extends('layouts.app')
@section('contents')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Data Jenis Hewan</h6>
                    </div>
                    <div class="card-header pb-0">
                        <a href="/jenishewan/create" class="btn btn-outline-danger">Insert</a>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Jenis Hewan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bold">Deskripsi</th>
                                </thead>
                                <tbody>

                                    @forelse($jenis_hewan as $jenis_hewan)
                                    <tr class="align-middle text-center text-sm text-xs font-weight-bold mb-0">
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $jenis_hewan->nama_jenis }}</td>
                                            <td>{{ $jenis_hewan->deskripsi }}</td>
                                            <td><a href="/jenishewan/{{ $jenis_hewan->id_jenis_hewan }}/edit" class="btn btn-warning">Edit</a>
												<form action="/jenishewan/{{$jenis_hewan->id_jenis_hewan}}" method="post" class="d-inline">
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
