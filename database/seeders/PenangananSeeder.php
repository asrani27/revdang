<?php

namespace Database\Seeders;

use App\Models\Penanganan;
use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Biaya;
use Illuminate\Database\Seeder;

class PenangananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengaduan = Pengaduan::whereIn('status', ['selesai', 'diproses'])->get();
        $petugas = Petugas::all();
        $biaya = Biaya::all();

        if ($pengaduan->isEmpty() || $petugas->isEmpty()) {
            return;
        }

        $penangananData = [
            [
                'pengaduan_id' => $pengaduan[0]->id,
                'petugas_id' => $petugas[0]->id,
                'biaya_id' => $biaya->isNotEmpty() ? $biaya->random()->id : null,
                'tanggal' => now()->subDays(9),
                'tindakan' => 'Melakukan pemeriksaan gardu distribusi dan menemukan trafo bermasalah. Dilakukan penggantian trafo dan pemeriksaan seluruh jaringan.',
                'hasil' => 'Listrik berhasil dinyalakan kembali setelah penggantian trafo. Seluruh jaringan dicek dan dinyatakan aman.',
                'status' => 'selesai',
            ],
            [
                'pengaduan_id' => $pengaduan[1]->id,
                'petugas_id' => $petugas[1]->id,
                'biaya_id' => $biaya->isNotEmpty() ? $biaya->random()->id : null,
                'tanggal' => now()->subDays(7),
                'tindakan' => 'Mengukur tegangan di beberapa titik, menemukan ada kabel yang longgar di panel distribusi. Dilakukan pengetatan dan penyesuaian.',
                'hasil' => 'Tegangan listrik stabil setelah kabel dikencangkan. Lampu tidak lagi berkedip.',
                'status' => 'selesai',
            ],
            [
                'pengaduan_id' => $pengaduan[2]->id,
                'petugas_id' => $petugas[2]->id,
                'biaya_id' => $biaya->isNotEmpty() ? $biaya->random()->id : null,
                'tanggal' => now()->subDays(5),
                'tindakan' => 'Sedang dalam proses pemeriksaan daya dan instalasi rumah pelanggan.',
                'hasil' => 'Proses masih berlangsung, menunggu konfirmasi pelanggan untuk pemadaman sementara.',
                'status' => 'diproses',
            ],
            [
                'pengaduan_id' => $pengaduan[3]->id,
                'petugas_id' => $petugas[3]->id,
                'biaya_id' => $biaya->isNotEmpty() ? $biaya->random()->id : null,
                'tanggal' => now()->subDays(4),
                'tindakan' => 'Melakukan pemeriksaan stop kontak dan menemukan adanya hubungan pendek. Stop kontak diganti dengan yang baru dan aman.',
                'hasil' => 'Stop kontak telah diganti. Seluruh titik stop kontak di rumah dicek dan dinyatakan aman.',
                'status' => 'selesai',
            ],
            [
                'pengaduan_id' => $pengaduan[4]->id,
                'petugas_id' => $petugas[0]->id,
                'biaya_id' => $biaya->isNotEmpty() ? $biaya->random()->id : null,
                'tanggal' => now()->subDays(3),
                'tindakan' => 'Sedang dalam proses penggantian meteran yang rusak dengan meteran baru.',
                'hasil' => 'Meteran telah diganti dengan yang baru. Menunggu kalibrasi dari tim teknis.',
                'status' => 'diproses',
            ],
        ];

        foreach ($penangananData as $data) {
            // Only create if pengaduan exists
            if (Pengaduan::find($data['pengaduan_id'])) {
                Penanganan::create($data);
            }
        }
    }
}
