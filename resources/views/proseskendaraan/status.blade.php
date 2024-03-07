@extends('dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Status Pemesanan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Status Pemesanan Saya</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kendaraan</th>
                                <th>Akun Pemesan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->kendaraan->nama }}</td>
                                    <td>{{ $p->user->name }}</td>
                                    <td>{{ $p->tanggal_pemesanan }}</td>
                                    <td>{{ $p->jumlah }}</td>
                                    <td
                                        style="color: 
                                                @if ($p->status == 'Diajukan' || $p->status == 'Dipesan') orange;
                                                @elseif ($p->status == 'Disetujui')
                                                    green;
                                                @elseif ($p->status == 'Ditolak')
                                                    red; @endif">
                                        {{ $p->status }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
