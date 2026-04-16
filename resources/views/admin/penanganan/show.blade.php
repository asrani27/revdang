@extends('layouts.app')

@section('title', 'Detail Penanganan')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.penanganan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Penanganan</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Detail Penanganan</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Penanganan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Informasi lengkap data penanganan</p>
    </div>

    <!-- Content -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pengaduan -->
            <div>
                <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Pengaduan</label>
                <p class="text-slate-900 dark:text-white">{{ $penanganan->pengaduan->keluhan ?? '-' }}</p>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Pelanggan: {{ $penanganan->pengaduan->pelanggan->nama ?? '-' }}
                </p>
            </div>

            <!-- Petugas -->
            <div>
                <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Petugas</label>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">
                            {{ strtoupper(substr($penanganan->petugas->nama ?? '-', 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-slate-900 dark:text-white font-medium">{{ $penanganan->petugas->nama ?? '-' }}</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $penanganan->petugas->no_telepon ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Tanggal</label>
                <p class="text-slate-900 dark:text-white">{{ $penanganan->tanggal->format('d M Y') }}</p>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Status</label>
                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full {{ $penanganan->status_badge_color }}">
                    {{ ucfirst($penanganan->status) }}
                </span>
            </div>

            <!-- Tindakan -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Tindakan</label>
                <p class="text-slate-900 dark:text-white whitespace-pre-wrap">{{ $penanganan->tindakan }}</p>
            </div>

            <!-- Hasil -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Hasil</label>
                <p class="text-slate-900 dark:text-white whitespace-pre-wrap">{{ $penanganan->hasil }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
            <a href="{{ route('admin.data.penanganan') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                Kembali
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.data.penanganan.edit', $penanganan->id) }}" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection