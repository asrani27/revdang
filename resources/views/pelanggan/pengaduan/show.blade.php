@extends('layouts.app')

@section('title', 'Detail Pengaduan - Pelanggan')

@section('content')
<!-- Page Header -->
<div class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 px-4 sm:px-2 py-4 lg:py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3">
            <a href="{{ route('pelanggan.pengaduan.index') }}" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Detail Pengaduan</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">#PND-{{ str_pad($pengaduan->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8 mx-auto max-w-4xl">
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl">
        <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Status Card -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">Status Pengaduan</h2>
                @php
                    $statusClasses = [
                        'menunggu' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 border-yellow-200 dark:border-yellow-800',
                        'diproses' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border-blue-200 dark:border-blue-800',
                        'selesai' => 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 border-green-200 dark:border-green-800',
                        'ditolak' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 border-red-200 dark:border-red-800',
                    ];
                    $statusLabels = [
                        'menunggu' => 'Menunggu',
                        'diproses' => 'Sedang Diproses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                    ];
                    $statusIcons = [
                        'menunggu' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                        'diproses' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />',
                        'selesai' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                        'ditolak' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                    ];
                @endphp
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium border {{ $statusClasses[$pengaduan->status] ?? 'bg-slate-100 text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $statusIcons[$pengaduan->status] ?? '' !!}
                    </svg>
                    {{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}
                </span>
            </div>
            @if($pengaduan->status == 'selesai' && !$pengaduan->feedback)
            <a href="{{ route('pelanggan.feedback.create', ['pengaduan_id' => $pengaduan->id]) }}" 
                class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-medium rounded-xl shadow-lg shadow-green-500/30 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Beri Feedback
            </a>
            @endif
        </div>
    </div>

    <!-- Details Card -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Informasi Pengaduan</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- ID Pengaduan -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">ID Pengaduan</label>
                    <p class="text-slate-900 dark:text-white font-medium">#PND-{{ str_pad($pengaduan->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Tanggal Pengaduan</label>
                    <p class="text-slate-900 dark:text-white">{{ $pengaduan->tanggal->format('d F Y, H:i') }} WIB</p>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Kategori Gangguan</label>
                    <p class="text-slate-900 dark:text-white">{{ $pengaduan->gangguan->nama_gangguan ?? 'N/A' }}</p>
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Lokasi</label>
                    <p class="text-slate-900 dark:text-white">{{ $pengaduan->lokasi }}</p>
                </div>

                <!-- Keluhan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Deskripsi Keluhan</label>
                    <p class="text-slate-900 dark:text-white whitespace-pre-wrap">{{ $pengaduan->keluhan }}</p>
                </div>

                <!-- Foto -->
                @if($pengaduan->foto)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Foto Bukti</label>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Bukti" 
                        class="max-w-md rounded-xl border border-slate-200 dark:border-slate-600">
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Feedback Section -->
    @if($pengaduan->feedback)
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden mt-6">
        <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Feedback Anda</h3>
        </div>
        <div class="p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="flex">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= $pengaduan->feedback->rating ? 'text-yellow-400' : 'text-slate-300 dark:text-slate-600' }}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    @endfor
                </div>
                <span class="text-sm text-slate-500 dark:text-slate-400">{{ $pengaduan->feedback->rating }}/5</span>
            </div>
            @if($pengaduan->feedback->komentar)
            <p class="text-slate-700 dark:text-slate-300">{{ $pengaduan->feedback->komentar }}</p>
            @endif
            <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">
                Feedback diberikan pada {{ $pengaduan->feedback->created_at->format('d F Y, H:i') }} WIB
            </p>
        </div>
    </div>
    @endif
</div>
@endsection