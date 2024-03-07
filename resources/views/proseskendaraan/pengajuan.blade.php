@extends('dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pengajuan Pemesanan Kendaraan</h1>

        <!-- Form Pengajuan Pemesanan Kendaraan -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Pemesanan Kendaraan</h6>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('prosespengajuan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="kategori">Kategori Kendaraan</label>
                            <select class="form-control @error('kategori') is-invalid @enderror" id="kategori"
                                name="kategori">
                                <option value="1">Pengangkut Barang</option>
                                <option value="2">Pengangkut Orang</option>
                            </select>
                            @error('kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kendaraan">Kendaraan</label>
                            <select class="form-control @error('kendaraan') is-invalid @enderror" id="kendaraan"
                                name="kendaraan">
                                {{-- nama kendaraan akan tampil disini --}}
                            </select>
                            @error('kendaraan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="akun_id">Akun Pemesan</label>
                        <input type="text" class="form-control" id="akun_id" name="akun_id"
                            value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                        <input type="date" class="form-control @error('tanggal_pemesanan') is-invalid @enderror"
                            id="tanggal_pemesanan" name="tanggal_pemesanan"
                            min="{{ \Carbon\Carbon::now()->addDays(5)->format('Y-m-d') }}">
                        @error('tanggal_pemesanan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                            name="jumlah" min="1" max="3">
                        @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="Diajukan" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection
