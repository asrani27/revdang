<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelangganData = [
            [
                'nik' => '630201001',
                'nama' => 'Rina Marlina',
                'alamat' => 'Jl. Ahmad Yani No. 10, Banjarmasin',
                'telp' => '082234567890',
                'daya' => '900',
                'nomor_meter' => 'MLG-001',
                'user_id' => null,
            ],
            [
                'nik' => '630201002',
                'nama' => 'Hendra Gunawan',
                'alamat' => 'Jl. Pangeran Samudera No. 25, Banjarmasin',
                'telp' => '082234567891',
                'daya' => '1300',
                'nomor_meter' => 'MLG-002',
                'user_id' => null,
            ],
            [
                'nik' => '630201003',
                'nama' => 'Siti Nurhaliza',
                'alamat' => 'Jl. Belitung Timur No. 8, Banjarmasin',
                'telp' => '082234567892',
                'daya' => '900',
                'nomor_meter' => 'MLG-003',
                'user_id' => null,
            ],
            [
                'nik' => '630201004',
                'nama' => 'Agus Setiawan',
                'alamat' => 'Jl. Hasan Basri No. 15, Banjarmasin',
                'telp' => '082234567893',
                'daya' => '2200',
                'nomor_meter' => 'MLG-004',
                'user_id' => null,
            ],
            [
                'nik' => '630201005',
                'nama' => 'Maya Putri',
                'alamat' => 'Jl. Martapura No. 30, Martapura',
                'telp' => '082234567894',
                'daya' => '1300',
                'nomor_meter' => 'MLG-005',
                'user_id' => null,
            ],
            [
                'nik' => '630201006',
                'nama' => 'Andi Rahman',
                'alamat' => 'Jl. Inspeksi No. 12, Banjarbaru',
                'telp' => '082234567895',
                'daya' => '900',
                'nomor_meter' => 'MLG-006',
                'user_id' => null,
            ],
            [
                'nik' => '630201007',
                'nama' => 'Lisa Amalia',
                'alamat' => 'Jl. Peluang No. 5, Banjarmasin',
                'telp' => '082234567896',
                'daya' => '1300',
                'nomor_meter' => 'MLG-007',
                'user_id' => null,
            ],
            [
                'nik' => '630201008',
                'nama' => 'Dedi Kurniawan',
                'alamat' => 'Jl. Dharma Bakti No. 18, Banjarmasin',
                'telp' => '082234567897',
                'daya' => '2200',
                'nomor_meter' => 'MLG-008',
                'user_id' => null,
            ],
        ];

        foreach ($pelangganData as $data) {
            Pelanggan::create($data);
        }
    }
}
