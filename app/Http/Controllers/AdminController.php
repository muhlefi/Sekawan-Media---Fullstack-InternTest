<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class AdminController extends Controller
{
    public function index()
    {
        // Mendapatkan data pemesanan dengan status 'Diajukan'
        $pengajuan = Pemesanan::where('status', 'Diajukan')->get();

        return view('proseskendaraan.followup', compact('pengajuan'));
    }

    public function followUp($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status' => 'Dipesan']);

        return redirect()->back()->with('success', 'Status pemesanan berhasil diubah menjadi Dipesan.');
    }

    public function tolak($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status' => 'Ditolak']);

        return redirect()->back()->with('success', 'Status pemesanan berhasil ditolak.');
    }
}
