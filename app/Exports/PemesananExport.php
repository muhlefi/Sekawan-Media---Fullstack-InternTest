<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemesananExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil data pemesanan yang memiliki status 'Disetujui'
        $pemesanan = Pemesanan::where('status', 'Disetujui')->get();

        // Transformasi data untuk mengganti ID kendaraan dengan nama kendaraan
        $pemesanan->transform(function ($item) {
            $item->kendaraans_id = $item->kendaraan->nama;
            unset($item->kendaraan); // Hapus relasi kendaraan agar tidak dimasukkan ke dalam Excel
            return $item;
        });

        // Transformasi data untuk mengganti ID pengguna dengan nama pengguna
        $pemesanan->transform(function ($item) {
            $item->user_id = $item->user->nama;
            unset($item->user); // Hapus relasi user agar tidak dimasukkan ke dalam Excel
            return $item;
        });

        return $pemesanan;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Kendaraan',
            'User',
            'Tanggal Pemesanan',
            'Jumlah',
            'Status',
            'Created At',
            'Updated At'
        ];
    }
}
