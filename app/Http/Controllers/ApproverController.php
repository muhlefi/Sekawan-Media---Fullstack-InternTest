<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class ApproverController extends Controller
{
    public function index()
    {
        // Mendapatkan data pemesanan dengan status 'Diajukan'
        $pengajuan = Pemesanan::where('status', 'Dipesan')->get();

        return view('proseskendaraan.persetujuan', compact('pengajuan'));
    }

    public function setuju($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status' => 'Disetujui']);

        return redirect()->back()->with('success', 'Status pemesanan berhasil diubah menjadi Disetujui,silahkan cek di tabel riwayat.');
    }

    public function tolak($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status' => 'Ditolak']);

        return redirect()->back()->with('success', 'Status pemesanan berhasil ditolak.');
    }
}
