<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Account
        DB::table('users')->insert([
            'username' => 'revdang',
            'name' => 'Administrator',
            'email' => 'admin@revdang.co.id',
            'password' => Hash::make('revdang'),
            'role' => 'admin',
            'status_akun' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Petugas Accounts (10 data)
        $petugasNames = [
            'Budi Santoso',
            'Ahmad Wijaya',
            'Dewi Lestari',
            'Rizky Pratama',
            'Siti Nurhaliza',
            'Joko Susilo',
            'Rina Marlina',
            'Hendra Kusuma',
            'Putri Ayu',
            'Dimas Ardiansyah'
        ];

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'username' => 'petugas' . ($i + 1),
                'name' => $petugasNames[$i],
                'email' => 'petugas' . ($i + 1) . '@revdang.co.id',
                'password' => Hash::make('petugas'),
                'role' => 'petugas',
                'status_akun' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Pelanggan Accounts (10 data)
        $pelangganNames = [
            'Andi Nugroho',
            'Maria Natalia',
            'Fajar Ramadhan',
            'Nisa Khoirunnisa',
            'Bayu Firmansyah',
            'Yuni Sartika',
            'Galih Ratna',
            'Taufik Hidayat',
            'Anisa Rahma',
            'Wahyu Setiawan'
        ];

        for ($i = 0; $i < 10; $i++) {
            $randomUsername = substr(str_shuffle('0123456789'), 0, 10);
            DB::table('users')->insert([
                'username' => $randomUsername,
                'name' => $pelangganNames[$i],
                'email' => 'pelanggan' . ($i + 1) . '@email.com',
                'password' => Hash::make('pelanggan'),
                'role' => 'pelanggan',
                'status_akun' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
