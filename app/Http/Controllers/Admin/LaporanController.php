<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Pelanggan;
use App\Models\Gangguan;
use App\Models\Pengaduan;
use App\Models\Penanganan;
use App\Models\Feedback;
use App\Models\LogAktivitas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display laporan users page
     */
    public function user()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.laporan.user', compact('users'));
    }

    /**
     * Generate PDF for user laporan
     */
    public function userPdf()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.user', [
            'users' => $users,
            'title' => 'Laporan User',
            'tanggal' => now()->format('d/m/Y H:i:s'),
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-user-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display laporan petugas page
     */
    public function petugas()
    {
        $petugas = Petugas::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.petugas', compact('petugas'));
    }

    /**
     * Generate PDF for petugas laporan
     */
    public function petugasPdf()
    {
        $petugas = Petugas::with('user')->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.petugas', [
            'petugas' => $petugas,
            'title' => 'Laporan Petugas',
            'tanggal' => now()->format('d/m/Y H:i:s'),
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-petugas-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display laporan pelanggan page
     */
    public function pelanggan()
    {
        $pelanggan = Pelanggan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.pelanggan', compact('pelanggan'));
    }

    /**
     * Generate PDF for pelanggan laporan
     */
    public function pelangganPdf()
    {
        $pelanggan = Pelanggan::with('user')->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.pelanggan', [
            'pelanggan' => $pelanggan,
            'title' => 'Laporan Pelanggan',
            'tanggal' => now()->format('d/m/Y H:i:s'),
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-pelanggan-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display laporan gangguan page
     */
    public function gangguan()
    {
        $gangguan = Gangguan::orderBy('created_at', 'desc')->get();
        return view('admin.laporan.gangguan', compact('gangguan'));
    }

    /**
     * Generate PDF for gangguan laporan
     */
    public function gangguanPdf()
    {
        $gangguan = Gangguan::orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.gangguan', [
            'gangguan' => $gangguan,
            'title' => 'Laporan Gangguan',
            'tanggal' => now()->format('d/m/Y H:i:s'),
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-gangguan-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display laporan pengaduan page
     */
    public function pengaduan()
    {
        $pengaduan = Pengaduan::with(['pelanggan', 'gangguan'])->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.pengaduan', compact('pengaduan'));
    }

    /**
     * Generate PDF for pengaduan laporan
     */
    public function pengaduanPdf()
    {
        $pengaduan = Pengaduan::with(['pelanggan', 'gangguan'])->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.pengaduan', [
            'pengaduan' => $pengaduan,
            'title' => 'Laporan Pengaduan',
            'tanggal' => now()->format('d/m/Y H:i:s'),
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-pengaduan-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display laporan penanganan page
     */
    public function penanganan()
    {
        $penanganan = Penanganan::with(['pengaduan.pelanggan', 'pengaduan.gangguan'])->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.penanganan', compact('penanganan'));
    }

    /**
     * Generate PDF for penanganan laporan
     */
    public function penangananPdf()
    {
        $penanganan = Penanganan::with(['pengaduan.pelanggan', 'pengaduan.gangguan'])->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.penanganan', [
            'penanganan' => $penanganan,
            'title' => 'Laporan Penanganan',
            'tanggal' => now()->format('d/m/Y H:i:s'),
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-penanganan-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display laporan feedback page
     */
    public function feedback()
    {
        $feedback = Feedback::with(['pengaduan.pelanggan'])->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.feedback', compact('feedback'));
    }

    /**
     * Generate PDF for feedback laporan
     */
    public function feedbackPdf()
    {
        $feedback = Feedback::with(['pengaduan.pelanggan'])->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.feedback', [
            'feedback' => $feedback,
            'title' => 'Laporan Feedback',
            'tanggal' => now()->format('d/m/Y H:i:s'),
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-feedback-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display laporan log aktivitas page
     */
    public function logAktivitas()
    {
        $logAktivitas = LogAktivitas::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.log-aktivitas', compact('logAktivitas'));
    }

    /**
     * Generate PDF for log aktivitas laporan
     */
    public function logAktivitasPdf()
    {
        $logAktivitas = LogAktivitas::with('user')->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.log-aktivitas', [
            'logAktivitas' => $logAktivitas,
            'title' => 'Laporan Log Aktivitas',
            'tanggal' => now()->format('d/m/Y H:i:s'),
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-log-aktivitas-' . date('Y-m-d') . '.pdf');
    }
}
