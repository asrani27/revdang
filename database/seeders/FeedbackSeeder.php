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

        if ($pengaduan->isEmpty()) {
            return;
        }

        $feedbackData = [
            [
                'pengaduan_id' => $pengaduan[0]->id,
                'rating' => 5,
                'komentar' => 'Pelayanan sangat memuaskan! Petugas datang tepat waktu dan bekerja dengan profesional. Listrik sudah berfungsi normal kembali.',
            ],
            [
                'pengaduan_id' => $pengaduan[1]->id,
                'rating' => 4,
                'komentar' => 'Masalah tegangan sudah teratasi dengan baik. Terima kasih atas respons yang cepat.',
            ],
            [
                'pengaduan_id' => $pengaduan[2]->id,
                'rating' => 4,
                'komentar' => 'Petugas ramah dan menjelaskan dengan detail. Namun proses agak memakan waktu karena perlu pemadaman.',
            ],
            [
                'pengaduan_id' => $pengaduan[3]->id,
                'rating' => 5,
                'komentar' => 'Sangat puas dengan penanganan stop kontak. Sekarang aman untuk digunakan.',
            ],
        ];

        foreach ($feedbackData as $data) {
            // Only create if pengaduan exists and doesn't have feedback yet
            if (Pengaduan::find($data['pengaduan_id']) && !Feedback::where('pengaduan_id', $data['pengaduan_id'])->exists()) {
                Feedback::create($data);
            }
        }
    }
}
