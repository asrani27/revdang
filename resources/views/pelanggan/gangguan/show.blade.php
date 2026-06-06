@extends('layouts.app')

@section('title', 'Detail Gangguan - Pelanggan')

@section('content')
<!-- Page Header -->
<div class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 px-4 sm:px-2 py-4 lg:py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3">
            <a href="{{ route('pelanggan.gangguan.index') }}" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Detail Gangguan</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $gangguan->nama_gangguan }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8 mx-auto max-w-4xl">
    <!-- Gangguan Info -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Informasi Gangguan</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Gangguan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Nama Gangguan</label>
                    <p class="text-slate-900 dark:text-white text-lg font-medium">{{ $gangguan->nama_gangguan }}</p>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Deskripsi</label>
                    <p class="text-slate-900 dark:text-white">{{ $gangguan->deskripsi }}</p>
                </div>

                <!-- Jumlah Laporan -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Jumlah Laporan Saya</label>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $gangguan->pengaduan->count() }} pengaduan</p>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Tanggal Dibuat</label>
                    <p class="text-slate-900 dark:text-white">{{ $gangguan->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaduan Terkait -->
    @if($gangguan->pengaduan->isNotEmpty())
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Pengaduan Saya Terkait</h3>
        </div>
        <div class="divide-y divide-slate-200 dark:divide-slate-700">
            @foreach($gangguan->pengaduan as $pengaduan)
            <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 3L4 14h7v7l9-11h-7V3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-slate-900 dark:text-white text-sm">#PND-{{ str_pad($pengaduan->id, 4, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $pengaduan->tanggal->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @php
                            $statusClasses = [
                                'menunggu' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400',
                                'diproses' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
                                'selesai' => 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400',
                                'ditolak' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
                            ];
                            $statusLabels = [
                                'menunggu' => 'Menunggu',
                                'diproses' => 'Diproses',
                                'selesai' => 'Selesai',
                                'ditolak' => 'Ditolak',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClasses[$pengaduan->status] ?? 'bg-slate-100 text-slate-700' }}">
                            {{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}
                        </span>
                        <a href="{{ route('pelanggan.pengaduan.show', $pengaduan->id) }}" class="text-sm text-yellow-600 dark:text-yellow-400 hover:text-yellow-700">
                            Detail →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection