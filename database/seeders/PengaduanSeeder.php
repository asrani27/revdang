<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use App\Models\Pelanggan;
use App\Models\Gangguan;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggan = Pelanggan::all();
        $gangguan = Gangguan::all();

        if ($pelanggan->isEmpty() || $gangguan->isEmpty()) {
            return;
        }

        $pengaduanData = [
            [
                'pelanggan_id' => $pelanggan[0]->id,
                'gangguan_id' => $gangguan[0]->id,
                'tanggal' => now()->subDays(10),
                'keluhan' => 'Listrik di rumah padam sejak tadi malam. Semua peralatan elektronik tidak bisa digunakan.',
                'lokasi' => 'Jl. Ahmad Yani No. 10, Banjarmasin',
                'status' => 'selesai',
                'foto' => null,
            ],
            [
                'pelanggan_id' => $pelanggan[1]->id,
                'gangguan_id' => $gangguan[1]->id,
                'tanggal' => now()->subDays(8),
                'keluhan' => 'Tegangan listrik tidak stabil, lampu berkedip-kedip terus.',
                'lokasi' => 'Jl. Pangeran Samudera No. 25, Banjarmasin',
                'status' => 'selesai',
                'foto' => null,
            ],
            [
                'pelanggan_id' => $pelanggan[2]->id,
                'gangguan_id' => $gangguan[2]->id,
                'tanggal' => now()->subDays(6),
                'keluhan' => 'Daya listrik terasa lemah, AC dan mesin cuci tidak berjalan optimal.',
                'lokasi' => 'Jl. Belitung Timur No. 8, Banjarmasin',
                'status' => 'diproses',
                'foto' => null,
            ],
            [
                'pelanggan_id' => $pelanggan[3]->id,
                'gangguan_id' => $gangguan[3]->id,
                'tanggal' => now()->subDays(5),
                'keluhan' => 'Terdapat percikan api dari stop kontak saat menyalakan mesin cuci.',
                'lokasi' => 'Jl. Hasan Basri No. 15, Banjarmasin',
                'status' => 'selesai',
                'foto' => null,
            ],
            [
                'pelanggan_id' => $pelanggan[4]->id,
                'gangguan_id' => $gangguan[4]->id,
                'tanggal' => now()->subDays(4),
                'keluhan' => 'Meteran listrik tidak menampilkan angka, khawatir tagihan tidak akurat.',
                'lokasi' => 'Jl. Martapura No. 30, Martapura',
                'status' => 'diproses',
                'foto' => null,
            ],
            [
                'pelanggan_id' => $pelanggan[5]->id,
                'gangguan_id' => $gangguan[5]->id,
                'tanggal' => now()->subDays(3),
                'keluhan' => 'Jaringan listrik sering putus di area ini, terutama saat hujan.',
                'lokasi' => 'Jl. Inspeksi No. 12, Banjarbaru',
                'status' => 'menunggu',
                'foto' => null,
            ],
            [
                'pelanggan_id' => $pelanggan[6]->id,
                'gangguan_id' => $gangguan[6]->id,
                'tanggal' => now()->subDays(2),
                'keluhan' => 'Kabel listrik di depan rumah terlihat kendur dan mengkhawatirkan.',
                'lokasi' => 'Jl. Peluang No. 5, Banjarmasin',
                'status' => 'menunggu',
                'foto' => null,
            ],
            [
                'pelanggan_id' => $pelanggan[7]->id,
                'gangguan_id' => $gangguan[7]->id,
                'tanggal' => now()->subDays(1),
                'keluhan' => 'Sering sekali mcchu (mini circuit breaker) jatuh saat menggunakan banyak peralatan.',
                'lokasi' => 'Jl. Dharma Bakti No. 18, Banjarmasin',
                'status' => 'menunggu',
                'foto' => null,
            ],
        ];

        foreach ($pengaduanData as $data) {
            Pengaduan::create($data);
        }
    }
}
