<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Exports\PemesananExport;
use Maatwebsite\Excel\Facades\Excel;


class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::all();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')
                         ->with('success','Kendaraan deleted successfully');
    }

    public function generateExcel()
    {
        return Excel::download(new PemesananExport, 'pemesanan.xlsx');
    }

}
