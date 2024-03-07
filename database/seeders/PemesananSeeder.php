<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemesanan;
use App\Models\Kendaraan;
use App\Models\Akun;
use Carbon\Carbon;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat pemesanan dengan data kendaraan dan akun yang telah ditentukan
        Pemesanan::create([
            'kendaraans_id' => 1, // Ganti dengan ID kendaraan yang sesuai
            'user_id' => 1, // Ganti dengan ID akun yang sesuai
            'tanggal_pemesanan' => Carbon::now()->subDays(5),
            'jumlah' => 3,
            'status' => 'Diajukan'
        ]);

        Pemesanan::create([
            'kendaraans_id' => 2, 
            'user_id' => 2, 
            'tanggal_pemesanan' => Carbon::now()->subDays(10),
            'jumlah' => 2,
            'status' => 'Diajukan'
        ]);

        // Tambahkan data pemesanan lainnya sesuai kebutuhan
    }
}
