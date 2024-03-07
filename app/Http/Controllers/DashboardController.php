<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data jumlah pesanan per kendaraan dengan nama kendaraan
        $data = Pemesanan::join('kendaraans', 'pemesanans.kendaraans_id', '=', 'kendaraans.id')
        ->where('pemesanans.status', 'Disetujui')
        ->select('kendaraans.nama', DB::raw('count(*) as total_pemesanan'))
        ->groupBy('kendaraans.nama')
        ->pluck('total_pemesanan', 'kendaraans.nama');
    


        return view('isidashboard', ['data' => $data]);
    }
}
