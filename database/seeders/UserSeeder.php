<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Muhammad Lefi',
                'email' => 'lefi@approver.com',
                'phone_number' => '081112223334',
                'role' => 'approver',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lefi Sasongko',
                'email' => 'lefi@admin.com',
                'phone_number' => '082223334445',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pragos Lefi',
                'email' => 'lefisatu@karyawan.com',
                'phone_number' => '083334445556',
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lefi Prasetyo',
                'email' => 'lefidua@karyawan.com',
                'phone_number' => '085556667778',
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
