@extends('dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pemesanan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pemesanan</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kendaraan</th>
                                <th>Akun</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                @if (Auth::user()->role == 'approver')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanans as $index => $pemesanan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pemesanan->kendaraan->nama }}</td>
                                    <td>{{ $pemesanan->user->name }}</td>
                                    <td>{{ $pemesanan->tanggal_pemesanan }}</td>
                                    <td>{{ $pemesanan->jumlah }}</td>
                                    <td
                                        style="color: 
                                                @if ($pemesanan->status == 'Diajukan' || $pemesanan->status == 'Dipesan') orange;
                                                @elseif ($pemesanan->status == 'Disetujui')
                                                    green;
                                                @elseif ($pemesanan->status == 'Ditolak')
                                                    red; @endif">
                                        {{ $pemesanan->status }}
                                    </td>
                                    @if (Auth::user()->role == 'approver')
                                    <td>
                                        <!-- Tombol Delete -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $pemesanan->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
        
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $pemesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus kendaraan ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Ya</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
