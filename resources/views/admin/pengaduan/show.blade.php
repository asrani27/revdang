@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li><a href="{{ route('admin.data.pengaduan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Pengaduan</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Detail Pengaduan</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Pengaduan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Informasi lengkap pengaduan pelanggan</p>
    </div>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.data.pengaduan') }}" class="inline-flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Data Pengaduan
        </a>
    </div>

    <!-- Detail Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="h-24 bg-gradient-to-r from-yellow-400 to-yellow-600"></div>
        <div class="px-6 pb-6">
            <div class="flex -mt-12 mb-4">
                <div class="w-24 h-24 rounded-full bg-white dark:bg-slate-700 border-4 border-white dark:border-slate-800 flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-yellow-500">{{ strtoupper(substr($pengaduan->pelanggan->nama ?? 'P', 0, 1)) }}</span>
                </div>
            </div>

            <div class="flex items-start justify-between flex-wrap gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Pengaduan #{{ $pengaduan->id }}</h2>
                    <p class="text-slate-500 dark:text-slate-400">{{ $pengaduan->pelanggan->nama ?? '-' }} - {{ $pengaduan->pelanggan->no_meter ?? '-' }}</p>
                </div>
                <div class="flex gap-2">
                    <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full {{ $pengaduan->status_badge_color }}">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                    <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                        {{ $pengaduan->gangguan->nama_gangguan ?? '-' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tanggal -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Tanggal</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pengaduan->tanggal->format('d M Y') }}</p>
                </div>

                <!-- Pelanggan -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Pelanggan</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pengaduan->pelanggan->nama ?? '-' }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">No. Meter: {{ $pengaduan->pelanggan->no_meter ?? '-' }}</p>
                </div>

                <!-- Gangguan -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Jenis Gangguan</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pengaduan->gangguan->nama_gangguan ?? '-' }}</p>
                </div>

                <!-- Lokasi -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Lokasi</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pengaduan->lokasi }}</p>
                </div>

                <!-- Keluhan (Full Width) -->
                <div class="md:col-span-2 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Keluhan</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pengaduan->keluhan }}</p>
                </div>

                <!-- Foto (if exists) -->
                @if($pengaduan->foto)
                <div class="md:col-span-2 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Foto Bukti</span>
                    </div>
                    <div class="mt-2">
                        <img src="{{ asset('uploads/pengaduan/' . $pengaduan->foto) }}" alt="Foto Bukti" class="max-w-md rounded-lg border border-slate-200 dark:border-slate-600">
                    </div>
                </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.pengaduan.edit', $pengaduan->id) }}" class="px-4 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit Pengaduan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
