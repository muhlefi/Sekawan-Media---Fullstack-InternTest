@extends('dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{ route('generate-excel') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Excel
        </a>
    </div>

    <div class="row">
        <!-- Bar Chart -->
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Total Pemesanan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('chartjs')
<script src="{{ asset('dbassets/vendor/chart.js/Chart.min.js') }}"></script>
<script>
    var data = {!! json_encode($data) !!};
    var labels = Object.keys(data);
    var values = Object.values(data);

    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar', // Ubah tipe chart menjadi bar
        data: {
            labels: labels,
            datasets: [{
                label: "Total Pemesanan per Kendaraan",
                backgroundColor: "rgba(78, 115, 223, 0.5)", // Ubah warna latar belakang batang
                borderColor: "rgba(78, 115, 223, 1)", // Ubah warna garis batas batang
                borderWidth: 2,
                data: values,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection
