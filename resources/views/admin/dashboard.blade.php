@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 px-4 sm:px-2 py-4 lg:py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Dashboard</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Selamat datang di panel administrator</p>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Content -->
<div class="p-4 sm:p-6 lg:p-8 mx-auto">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">

        <!-- Total Pengaduan -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 lg:p-6 border border-slate-200 dark:border-slate-700 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-semibold px-2.5 py-1 rounded-full">Total</span>
            </div>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mb-1">{{ $totalPengaduan }}</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Pengaduan</p>
        </div>

        <!-- Pending -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 lg:p-6 border border-slate-200 dark:border-slate-700 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
            </div>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mb-1">{{ $pendingCount }}</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">Menunggu Tindakan</p>
        </div>

        <!-- Diproses -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 lg:p-6 border border-slate-200 dark:border-slate-700 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 text-xs font-semibold px-2.5 py-1 rounded-full">Diproses</span>
            </div>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mb-1">{{ $diprosesCount }}</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">Sedang Diproses</p>
        </div>

        <!-- Selesai -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 lg:p-6 border border-slate-200 dark:border-slate-700 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-semibold px-2.5 py-1 rounded-full">Selesai</span>
            </div>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mb-1">{{ $selesaiCount }}</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">Pengaduan Selesai</p>
        </div>
    </div>

    <!-- Charts & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6 lg:mb-8">

        <!-- Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="px-5 py-4 lg:px-6 lg:py-5 border-b border-slate-200 dark:border-slate-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <h3 class="text-base lg:text-lg font-semibold text-slate-900 dark:text-white">Statistik Pengaduan</h3>
                    <div class="flex items-center gap-2">
                        <select class="text-sm bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-1.5 text-slate-600 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option>Bulan ini</option>
                            <option>Minggu ini</option>
                            <option>Tahun ini</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-5 lg:p-6">
                <div class="h-64 lg:h-80" id="chartContainer"></div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="px-5 py-4 lg:px-6 lg:py-5 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-base lg:text-lg font-semibold text-slate-900 dark:text-white">Status Hari Ini</h3>
            </div>
            <div class="p-5 lg:p-6 space-y-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Menunggu</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">{{ $todayMenunggu }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Sedang Dicek</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">{{ $todayDicek }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1h-1a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Dalam Pengerjaan</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">{{ $todayPengerjaan }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Selesai</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">{{ $todaySelesai }}</span>
                </div>

                <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">Total Hari Ini</span>
                        <span class="text-xl font-bold text-yellow-500">{{ $todayTotal }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Pengaduan Table -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="px-5 py-4 lg:px-6 lg:py-5 border-b border-slate-200 dark:border-slate-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <h3 class="text-base lg:text-lg font-semibold text-slate-900 dark:text-white">Pengaduan Terbaru</h3>
                <a href="{{ route('admin.data.pengaduan') }}" class="inline-flex items-center gap-1 text-sm font-medium text-yellow-600 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        @forelse($recentPengaduan as $pengaduan)
        <!-- Mobile View - Cards -->
        <div class="lg:hidden divide-y divide-slate-200 dark:divide-slate-700">
            <div class="p-4 space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 3L4 14h7v7l9-11h-7V3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-slate-900 dark:text-white text-sm">#PND-{{ str_pad($pengaduan->id, 3, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $pengaduan->keluhan }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $pengaduan->status_badge_color }}">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-slate-500 dark:text-slate-400">
            <p>Belum ada pengaduan</p>
        </div>
        @endforelse

        <!-- Desktop View - Table -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">ID Pengaduan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($recentPengaduan as $pengaduan)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-medium text-slate-900 dark:text-white">#PND-{{ str_pad($pengaduan->id, 3, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-white text-xs font-semibold">
                                    {{ strtoupper(substr($pengaduan->pelanggan->nama ?? 'U', 0, 1)) }}
                                </div>
                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ $pengaduan->pelanggan->nama ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-600 dark:text-slate-400 max-w-xs truncate">{{ $pengaduan->keluhan }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-slate-600 dark:text-slate-400">{{ $pengaduan->tanggal->format('d M Y') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $pengaduan->status_badge_color }}">
                                {{ ucfirst($pengaduan->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <a href="{{ route('admin.data.pengaduan.show', $pengaduan->id) }}" class="p-2 text-slate-400 hover:text-yellow-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p>Belum ada pengaduan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        const monthlyData = @json($monthlyData);
        
        const chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            backgroundColor: "transparent",
            axisX: {
                labelFontColor: "#64748b",
                tickColor: "#64748b",
                lineColor: "#e2e8f0",
                gridThickness: 0
            },
            axisY: {
                labelFontColor: "#64748b",
                tickColor: "#64748b",
                lineColor: "#e2e8f0",
                gridColor: "#e2e8f0",
                gridThickness: 1,
                includeZero: true
            },
            data: [{
                type: "column",
                color: "#3b82f6",
                dataPoints: monthlyData.map(item => ({
                    label: item.month,
                    y: item.count
                }))
            }]
        });
        
        chart.render();
    });
</script>
@endpush
@endsection
