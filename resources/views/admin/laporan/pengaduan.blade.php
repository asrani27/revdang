@extends('layouts.app')

@section('title', 'Laporan Pengaduan')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Laporan Pengaduan</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Data pengaduan dalam sistem</p>
        </div>
        <a href="{{ route('admin.laporan.pengaduan.pdf', ['bulan' => $bulan ?? null, 'tahun' => $tahun ?? null]) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors font-medium text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            CETAK PDF
        </a>
    </div>

    <!-- Filter Form -->
    <form action="{{ route('admin.laporan.pengaduan') }}" method="GET" class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1">
                <label for="bulan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bulan</label>
                <select name="bulan" id="bulan" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Semua Bulan --</option>
                    <option value="1" {{ ($bulan ?? '') == '1' ? 'selected' : '' }}>Januari</option>
                    <option value="2" {{ ($bulan ?? '') == '2' ? 'selected' : '' }}>Februari</option>
                    <option value="3" {{ ($bulan ?? '') == '3' ? 'selected' : '' }}>Maret</option>
                    <option value="4" {{ ($bulan ?? '') == '4' ? 'selected' : '' }}>April</option>
                    <option value="5" {{ ($bulan ?? '') == '5' ? 'selected' : '' }}>Mei</option>
                    <option value="6" {{ ($bulan ?? '') == '6' ? 'selected' : '' }}>Juni</option>
                    <option value="7" {{ ($bulan ?? '') == '7' ? 'selected' : '' }}>Juli</option>
                    <option value="8" {{ ($bulan ?? '') == '8' ? 'selected' : '' }}>Agustus</option>
                    <option value="9" {{ ($bulan ?? '') == '9' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ ($bulan ?? '') == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ ($bulan ?? '') == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ ($bulan ?? '') == '12' ? 'selected' : '' }}>Desember</option>
                </select>
            </div>
            <div class="flex-1">
                <label for="tahun" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tahun</label>
                <select name="tahun" id="tahun" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Semua Tahun --</option>
                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                    <option value="{{ $y }}" {{ ($tahun ?? '') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors font-medium text-sm">
                    Filter
                </button>
                <a href="{{ route('admin.laporan.pengaduan') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 dark:bg-slate-600 dark:hover:bg-slate-500 text-slate-700 dark:text-white rounded-lg transition-colors font-medium text-sm">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Gangguan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Keluhan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Lokasi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($pengaduan as $index => $p)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm text-slate-900 dark:text-white">{{ $p->pelanggan->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">{{ $p->gangguan->nama_gangguan ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $p->tanggal ? $p->tanggal->format('d/m/Y') : '-' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">{{ Str::limit($p->keluhan, 50) }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">{{ $p->lokasi }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full
                                @if($p->status === 'menunggu') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                                @elseif($p->status === 'diproses') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                @elseif($p->status === 'selesai') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                @elseif($p->status === 'ditolak') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                                @endif">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">Belum ada data pengaduan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
