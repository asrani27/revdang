<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Pelanggan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Account - only create if not exists
        if (!User::where('username', 'revdang')->exists()) {
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
        }

        // Petugas Accounts (5 data matching PetugasSeeder)
        $petugasNames = [
            'Ahmad Wijaya',
            'Budi Santoso',
            'Dewi Lestari',
            'Eko Prasetyo',
            'Fitri Handayani',
        ];

        for ($i = 0; $i < 5; $i++) {
            $username = 'petugas' . ($i + 1);
            if (!User::where('username', $username)->exists()) {
                $userId = DB::table('users')->insertGetId([
                    'username' => $username,
                    'name' => $petugasNames[$i],
                    'email' => 'petugas' . ($i + 1) . '@revdang.co.id',
                    'password' => Hash::make('petugas'),
                    'role' => 'petugas',
                    'status_akun' => 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                // Create Petugas with user_id
                if (!Petugas::where('nik', '63010100' . ($i + 1))->exists()) {
                    $jabatan = $i === 0 ? 'Teknisi Senior' : ($i === 2 ? 'Supervisor' : 'Teknisi');
                    $jabatan = $i === 4 ? 'Staff Administrasi' : $jabatan;
                    Petugas::create([
                        'nik' => '63010100' . ($i + 1),
                        'nama' => $petugasNames[$i],
                        'jabatan' => $jabatan,
                        'telp' => '08123456789' . $i,
                        'user_id' => $userId,
                    ]);
                }
            }
        }

        // Pelanggan Accounts (8 data matching PelangganSeeder)
        $pelangganNames = [
            'Rina Marlina',
            'Hendra Gunawan',
            'Siti Nurhaliza',
            'Agus Setiawan',
            'Maya Putri',
            'Andi Rahman',
            'Lisa Amalia',
            'Dedi Kurniawan',
        ];

        $pelangganAlamat = [
            'Jl. Ahmad Yani No. 10, Banjarmasin',
            'Jl. Pangeran Samudera No. 25, Banjarmasin',
            'Jl. Belitung Timur No. 8, Banjarmasin',
            'Jl. Hasan Basri No. 15, Banjarmasin',
            'Jl. Martapura No. 30, Martapura',
            'Jl. Inspeksi No. 12, Banjarbaru',
            'Jl. Peluang No. 5, Banjarmasin',
            'Jl. Dharma Bakti No. 18, Banjarmasin',
        ];

        for ($i = 0; $i < 8; $i++) {
            $username = 'pelanggan' . ($i + 1);
            $email = 'pelanggan' . ($i + 1) . '@revdang.co.id';
            if (!User::where('username', $username)->exists() && !User::where('email', $email)->exists()) {
                $userId = DB::table('users')->insertGetId([
                    'username' => $username,
                    'name' => $pelangganNames[$i],
                    'email' => $email,
                    'password' => Hash::make('pelanggan'),
                    'role' => 'pelanggan',
                    'status_akun' => 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                // Create Pelanggan with user_id
                if (!Pelanggan::where('nik', '63020100' . ($i + 1))->exists()) {
                    $daya = $i % 3 === 0 ? '900' : ($i % 3 === 1 ? '1300' : '2200');
                    Pelanggan::create([
                        'nik' => '63020100' . ($i + 1),
                        'nama' => $pelangganNames[$i],
                        'alamat' => $pelangganAlamat[$i],
                        'telp' => '08223456789' . $i,
                        'daya' => $daya,
                        'nomor_meter' => 'MLG-00' . ($i + 1),
                        'user_id' => $userId,
                    ]);
                }
            }
        }
    }
}
