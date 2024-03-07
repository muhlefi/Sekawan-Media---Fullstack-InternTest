@extends('dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Kendaraan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Kendaraan</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="editForm" action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $kendaraan->nama }}"
                            placeholder="Nama Kendaraan">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kendaraan">Jenis</label>
                        <select class="form-control @error('jenis_kendaraan') is-invalid @enderror" id="jenis_kendaraan" name="jenis_kendaraan">
                            <option value="Pengangkut Orang" {{ $kendaraan->jenis_kendaraan == 'Pengangkut Orang' ? 'selected' : '' }}>Pengangkut Orang</option>
                            <option value="Pengangkut Barang" {{ $kendaraan->jenis_kendaraan == 'Pengangkut Barang' ? 'selected' : '' }}>Pengangkut Barang</option>
                        </select>
                        @error('jenis_kendaraan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tahun_produksi">Tahun Produksi</label>
                        <input type="text" class="form-control @error('tahun_produksi') is-invalid @enderror" id="tahun_produksi" name="tahun_produksi"
                            value="{{ $kendaraan->tahun_produksi }}" placeholder="Tahun Produksi">
                        @error('tahun_produksi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">Simpan</button>
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>

                <!-- Confirm Modal -->
                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Penyimpanan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menyimpan perubahan?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" form="editForm" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
