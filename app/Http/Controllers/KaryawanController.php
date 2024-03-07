<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        // Mendapatkan id pengguna yang saat ini login
        $userId = auth()->user()->id;

        // Mengambil data pemesanan yang terkait dengan pengguna yang login
        $pengajuan = Pemesanan::where('user_id', $userId)->get();
        return view('proseskendaraan.status', compact('pengajuan'));
    }

    public function create()
    {
        return view('proseskendaraan.pengajuan');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kendaraan' => 'required',
            'tanggal_pemesanan' => 'required|date',
            'jumlah' => 'required|integer|min:1|max:3',
        ]);

        // Ambil ID kendaraan berdasarkan nama kendaraan yang dipilih dalam formulir
        $selectedKendaraan = $request->kendaraan;
        $idKendaraan = Kendaraan::where('nama', $selectedKendaraan)->value('id');

        // Simpan data pemesanan dengan menggunakan ID kendaraan yang ditemukan
        Pemesanan::create([
            'kendaraans_id' => $idKendaraan,
            'user_id' => auth()->user()->id,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'jumlah' => $request->jumlah,
            'status' => 'Diajukan',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pengajuan pemesanan kendaraan berhasil disimpan.');
    }
}
