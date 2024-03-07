@extends('dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Aktivitas Log</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Aktivitas Log</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('clear-activity-log') }}" method="POST" id="delete-log-form">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal">Hapus Semua Log Aktivitas</button>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus semua log aktivitas?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-log-form').submit();">Ya, Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Description</th>
                            <th>Causer</th>
                            <th>Role</th>
                            <th>Event</th>
                            <th>Properties</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->causer->name ?? 'System' }}</td>
                                <td>{{ $activity->causer->role ?? 'System' }}</td>
                                <td>{{ $activity->event }}</td>
                                <td>
                                    @foreach ($activity->properties as $key => $value)
                                        <p><strong>{{ $key }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</p>
                                    @endforeach
                                </td>
                                <td>{{ $activity->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
