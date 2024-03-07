@extends('dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Persetujuan Pemesanan</h1>

        <!-- Alert success -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Persetujuan Pemesanan</h6>
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
                                <th>Action</th>
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
                                    <td>
                                        @if ($p->status == 'Dipesan')
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#setujuiModal{{ $p->id }}">Setujui</button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#tolakModal{{ $p->id }}">Tolak</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Setujui Modal -->
    @foreach ($pengajuan as $p)
        <div class="modal fade" id="setujuiModal{{ $p->id }}" tabindex="-1" role="dialog"
            aria-labelledby="setujuiModalLabel{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="setujuiModalLabel{{ $p->id }}">Setujui Pemesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menyetujui pemesanan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <form action="{{ route('setuju', $p->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Setujui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Tolak Modal -->
    @foreach ($pengajuan as $p)
        <div class="modal fade" id="tolakModal{{ $p->id }}" tabindex="-1" role="dialog"
            aria-labelledby="tolakModalLabel{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tolakModalLabel{{ $p->id }}">Tolak Pemesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menolak pemesanan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <form action="{{ route('tolak', $p->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
