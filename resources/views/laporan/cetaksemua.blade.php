<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <title>Laporan Pemasukan</title>
</head>

<div class="row">
    <div class="col text-center">
        <h5 style="font-size: 20px;">Pit.Pit Pet Care</h5>
        <h6 style="font-size: 17px;">Petshop Dengan Layanan Terbaik</h6>
        <h6 style="font-size: 17px;">Bersih - Nyaman - Terpercaya</h6>
    </div>
    <hr><br>

    <div class="row">
        <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA;  font-size: 12px;" class="text-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Hewan</th>
                    <th>Nama Layanan</th>
                    <th>Nama Paket</th>
                    <th>Nama Dokter</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jam Antar</th>
                    <th>Jam Jemput</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Nomor Antrian</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px;">
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <td> {{ $loop ->iteration }} </td>
                        <td>{{ $transaksi->pelanggan->nama_pelanggan }}</td>
                        <td>{{ $transaksi->hewan->nama_hewan }}</td>
                        <td>{{ $transaksi->layanan->nama_layanan}}</td>
                        <td>{{ $transaksi->paket->nama_paket }}</td>
                        <td>{{ $transaksi->dokter->nama_dokter }}</td>
                        <td>{{ $transaksi->tgl_transaksi }}</td>
                        <td>{{ $transaksi->jam_antar }}</td>
                        <td>{{ $transaksi->jam_jemput }}</td>
                        <td>Rp. {{ number_format($transaksi->total, 2, ',', '.') }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td>{{ $transaksi->nomor_antrian }}</td>
                        <td>{{ $transaksi->deadline }}</td>
                       
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7"></th>
                    <td><b><i>Total Pemasukan</i></b></td>
                    <td><b><i>Rp. {{ number_format($totalPemasukan, 2) }}</i></b></td>
                </tr>
            </tfoot>
        </table>
    </div>

    </body>

</html>
