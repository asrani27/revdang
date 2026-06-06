<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Pelanggan;
use App\Models\Petugas;
use App\Models\Gangguan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalPengaduan = Pengaduan::count();
        $totalPelanggan = Pelanggan::count();
        $totalPetugas = Petugas::count();
        $totalGangguan = Gangguan::count();

        // Status counts for pengaduan
        $pendingCount = Pengaduan::where('status', 'menunggu')->count();
        $diprosesCount = Pengaduan::where('status', 'diproses')->count();
        $selesaiCount = Pengaduan::where('status', 'selesai')->count();

        // Today's stats
        $today = Carbon::today();
        $todayMenunggu = Pengaduan::whereDate('tanggal', $today)->where('status', 'menunggu')->count();
        $todayDicek = Pengaduan::whereDate('tanggal', $today)->where('status', 'dicek')->count();
        $todayPengerjaan = Pengaduan::whereDate('tanggal', $today)->where('status', 'pengerjaan')->count();
        $todaySelesai = Pengaduan::whereDate('tanggal', $today)->where('status', 'selesai')->count();
        $todayTotal = Pengaduan::whereDate('tanggal', $today)->count();

        // Monthly data for chart (last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonth($i);
            $count = Pengaduan::whereMonth('tanggal', $month->month)
                ->whereYear('tanggal', $month->year)
                ->count();
            $monthlyData[] = [
                'month' => $month->format('M'),
                'count' => $count
            ];
        }

        // Recent pengaduan (latest 5)
        $recentPengaduan = Pengaduan::with('pelanggan')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'totalPelanggan',
            'totalPetugas',
            'totalGangguan',
            'pendingCount',
            'diprosesCount',
            'selesaiCount',
            'todayMenunggu',
            'todayDicek',
            'todayPengerjaan',
            'todaySelesai',
            'todayTotal',
            'monthlyData',
            'recentPengaduan'
        ));
    }
}