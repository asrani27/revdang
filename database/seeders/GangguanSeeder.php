<?php

namespace Database\Seeders;

use App\Models\Gangguan;
use Illuminate\Database\Seeder;

class GangguanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gangguanData = [
            [
                'nama_gangguan' => 'Pemadaman Listrik',
                'deskripsi' => 'Kondisi dimana listrik padam total di suatu area',
            ],
            [
                'nama_gangguan' => 'Gangguan Tegangan',
                'deskripsi' => 'Tegangan listrik tidak stabil atau turun naik',
            ],
            [
                'nama_gangguan' => 'Kehilangan Tenaga',
                'deskripsi' => 'Daya listrik berkurang atau tidak mencukupi',
            ],
            [
                'nama_gangguan' => 'Konslet Listrik',
                'deskripsi' => 'Hubung singkat pada instalasi listrik',
            ],
            [
                'nama_gangguan' => 'Kerusakan Meteran',
                'deskripsi' => 'Meteran listrik rusak atau tidak berfungsi',
            ],
            [
                'nama_gangguan' => 'Gangguan Jaringan',
                'deskripsi' => 'Masalah pada jaringan distribusi listrik',
            ],
            [
                'nama_gangguan' => 'S昨夜 Saluran',
                'deskripsi' => 'Saluran listrik terputus atau rusak',
            ],
            [
                'nama_gangguan' => 'Beban Berlebih',
                'deskripsi' => 'Daya listrik melebihi kapasitas',
            ],
        ];

        foreach ($gangguanData as $data) {
            Gangguan::create($data);
        }
    }
}
