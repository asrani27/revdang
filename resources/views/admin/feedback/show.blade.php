@extends('layouts.app')

@section('title', 'Detail Feedback')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.feedback') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Feedback</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Detail Feedback</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Feedback</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Informasi lengkap feedback</p>
    </div>

    <!-- Detail Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- ID Pengaduan -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">ID Pengaduan</label>
                    <p class="text-lg font-semibold text-slate-900 dark:text-white">#{{ $feedback->pengaduan_id }}</p>
                </div>

                <!-- Pelanggan -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Pelanggan</label>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <span class="text-sm font-semibold text-purple-600 dark:text-purple-400">
                                {{ strtoupper(substr($feedback->pengaduan->pelanggan->nama ?? '-', 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $feedback->pengaduan->pelanggan->nama ?? '-' }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $feedback->pengaduan->pelanggan->no_meter ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Rating -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Rating</label>
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-400 text-xl">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $feedback->rating)
                                    ★
                                @else
                                    <span class="text-slate-300 dark:text-slate-600">★</span>
                                @endif
                            @endfor
                        </span>
                        <span class="text-lg font-semibold text-slate-900 dark:text-white">({{ $feedback->rating }}/5)</span>
                    </div>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Tanggal Feedback</label>
                    <p class="text-lg text-slate-900 dark:text-white">{{ $feedback->created_at->format('d M Y, H:i') }}</p>
                </div>

                <!-- Komentar -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Komentar</label>
                    <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                        <p class="text-slate-900 dark:text-white">{{ $feedback->komentar ?? 'Tidak ada komentar' }}</p>
                    </div>
                </div>

                <!-- Info Pengaduan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Info Pengaduan</label>
                    <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg space-y-2">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Jenis Gangguan</p>
                                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $feedback->pengaduan->gangguan->nama_gangguan ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Tanggal Pengaduan</p>
                                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $feedback->pengaduan->tanggal->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Status Pengaduan</p>
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full {{ $feedback->pengaduan->status_badge_color }}">
                                    {{ ucfirst($feedback->pengaduan->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-slate-200 dark:border-slate-600">
                            <p class="text-xs text-slate-500 dark:text-slate-400">Keluhan</p>
                            <p class="text-sm text-slate-900 dark:text-white">{{ $feedback->pengaduan->keluhan }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Lokasi</p>
                            <p class="text-sm text-slate-900 dark:text-white">{{ $feedback->pengaduan->lokasi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.feedback') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                    Kembali
                </a>
                <div class="flex gap-2">
                    <a href="{{ route('admin.data.feedback.edit', $feedback->id) }}" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">
                        Edit Feedback
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
