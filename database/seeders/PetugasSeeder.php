<?php

namespace Database\Seeders;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugasData = [
            [
                'nik' => '630101001',
                'nama' => 'Ahmad Wijaya',
                'jabatan' => 'Teknisi Senior',
                'telp' => '081234567890',
                'user_id' => null,
            ],
            [
                'nik' => '630101002',
                'nama' => 'Budi Santoso',
                'jabatan' => 'Teknisi',
                'telp' => '081234567891',
                'user_id' => null,
            ],
            [
                'nik' => '630101003',
                'nama' => 'Dewi Lestari',
                'jabatan' => 'Supervisor',
                'telp' => '081234567892',
                'user_id' => null,
            ],
            [
                'nik' => '630101004',
                'nama' => 'Eko Prasetyo',
                'jabatan' => 'Teknisi',
                'telp' => '081234567893',
                'user_id' => null,
            ],
            [
                'nik' => '630101005',
                'nama' => 'Fitri Handayani',
                'jabatan' => 'Staff Administrasi',
                'telp' => '081234567894',
                'user_id' => null,
            ],
        ];

        foreach ($petugasData as $data) {
            Petugas::create($data);
        }
    }
}
