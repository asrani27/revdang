<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Pengaduan;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengaduan = Pengaduan::where('status', 'selesai')->get();

        $komentar = [
            'Pelayanan sangat memuaskan! Petugas datang tepat waktu dan bekerja dengan profesional. Listrik sudah berfungsi normal kembali.',
            'Masalah tegangan sudah teratasi dengan baik. Terima kasih atas respons yang cepat.',
            'Petugas ramah dan menjelaskan dengan detail. Namun proses agak memakan waktu karena perlu pemadaman.',
            'Sangat puas dengan penanganan stop kontak. Sekarang aman untuk digunakan.',
        ];

        foreach ($pengaduan as $index => $p) {
            if ($index >= 4) break;
            
            if (!Feedback::where('pengaduan_id', $p->id)->exists()) {
                Feedback::create([
                    'pengaduan_id' => $p->id,
                    'rating' => $index < 2 ? 5 : 4,
                    'komentar' => $komentar[$index],
                ]);
            }
        }
    }
}
