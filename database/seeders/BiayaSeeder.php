<?php

namespace Database\Seeders;

use App\Models\Biaya;
use Illuminate\Database\Seeder;

class BiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $biayas = [
            [
                'kode' => 'B001',
                'nama' => 'Biaya Pendaftaran Baru',
                'jumlah' => 150000,
                'keterangan' => 'Biaya pendaftaran pelanggan baru termasuk instalasi awal',
            ],
            [
                'kode' => 'B002',
                'nama' => 'Biaya Bulanan Internet',
                'jumlah' => 250000,
                'keterangan' => 'Biaya langganan internet bulanan untuk paket dasar',
            ],
            [
                'kode' => 'B003',
                'nama' => 'Biaya Perbaikan Gangguan',
                'jumlah' => 75000,
                'keterangan' => 'Biaya penanganan gangguan jaringan diluar garansi',
            ],
            [
                'kode' => 'B004',
                'nama' => 'Biaya Install Ulang',
                'jumlah' => 100000,
                'keterangan' => 'Biaya install ulang perangkat pelanggan',
            ],
            [
                'kode' => 'B005',
                'nama' => 'Biaya Penggantian Modem',
                'jumlah' => 350000,
                'keterangan' => 'Biaya penggantian modem yang rusak atau hilang',
            ],
            [
                'kode' => 'B006',
                'nama' => 'Biaya Upgrade Paket',
                'jumlah' => 50000,
                'keterangan' => 'Biaya upgrade dari paket lama ke paket lebih tinggi',
            ],
            [
                'kode' => 'B007',
                'nama' => 'Biaya Kabel Extension',
                'jumlah' => 25000,
                'keterangan' => 'Biaya per meter kabel untuk perpanjangan instalasi',
            ],
            [
                'kode' => 'B008',
                'nama' => 'Biaya Layanan Premium',
                'jumlah' => 500000,
                'keterangan' => 'Biaya langganan paket premium dengan kecepatan tinggi',
            ],
            [
                'kode' => 'B009',
                'nama' => 'Biaya Penarikan Kabel',
                'jumlah' => 150000,
                'keterangan' => 'Biaya penarikan kabel baru dari tiang ke gedung',
            ],
            [
                'kode' => 'B010',
                'nama' => 'Biaya Denda Keterlambatan',
                'jumlah' => 25000,
                'keterangan' => 'Denda per hari untuk pembayaran yang terlambat',
            ],
            [
                'kode' => 'B011',
                'nama' => 'Biaya Aktivasi Ulang',
                'jumlah' => 50000,
                'keterangan' => 'Biaya aktivasi kembali layanan yang dinonaktifkan',
            ],
            [
                'kode' => 'B012',
                'nama' => 'Biaya Survey Lokasi',
                'jumlah' => 75000,
                'keterangan' => 'Biaya survey lokasi untuk pemasangan baru',
            ],
        ];

        foreach ($biayas as $biaya) {
            if (!Biaya::where('kode', $biaya['kode'])->exists()) {
                Biaya::create($biaya);
            }
        }
    }
}
