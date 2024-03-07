<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    // Fungsi untuk mencatat aktivitas sebelum redirect ke halaman index
    private function logActivityBeforeRedirect($activity)
    {
        activity()->causedBy(Auth::user())->log($activity);
    }

    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kendaraan' => 'required',
            'tahun_produksi' => 'required|integer',
        ]);
    
        Kendaraan::create($request->all());
        
        return redirect()->route('kendaraan.index')
                         ->with('success', 'Kendaraan created successfully.');
    }

    public function show(Kendaraan $kendaraan)
    {
        return view('kendaraan.show', compact('kendaraan'));
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kendaraan' => 'required',
            'tahun_produksi' => 'required|integer',
        ]);

        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')
                         ->with('success', 'Kendaraan updated successfully');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
                         ->with('success', 'Kendaraan deleted successfully');
    }
}
