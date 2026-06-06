@extends('layouts.app')

@section('title', 'Riwayat Feedback - Pelanggan')

@section('content')
<!-- Page Header -->
<div class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 px-4 sm:px-2 py-4 lg:py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Riwayat Feedback</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Riwayat feedback yang telah Anda berikan</p>
            </div>
            <a href="{{ route('pelanggan.feedback.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-medium rounded-xl shadow-lg shadow-yellow-500/30 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Beri Feedback Baru</span>
            </a>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8 mx-auto">
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl">
        <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Feedback List -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($feedback->isEmpty())
        <div class="p-12 text-center">
            <svg class="w-20 h-20 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-2">Belum Ada Feedback</h3>
            <p class="text-slate-500 dark:text-slate-400 mb-4">Berikan feedback untuk pengaduan yang sudah selesai</p>
            <a href="{{ route('pelanggan.feedback.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-xl transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Beri Feedback
            </a>
        </div>
        @else
        <div class="divide-y divide-slate-200 dark:divide-slate-700">
            @foreach($feedback as $item)
            <div class="p-6 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                    <div class="flex-1">
                        <!-- Header -->
                        <div class="flex items-center gap-3 mb-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                                #PND-{{ str_pad($item->pengaduan->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="text-sm text-slate-500 dark:text-slate-400">
                                {{ $item->created_at->format('d M Y, H:i') }} WIB
                            </span>
                        </div>
                        
                        <!-- Pengaduan Info -->
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">
                            {{ $item->pengaduan->gangguan->nama_gangguan ?? 'N/A' }} - {{ $item->pengaduan->keluhan }}
                        </p>
                        
                        <!-- Rating -->
                        <div class="flex items-center gap-2 mb-3">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $item->rating ? 'text-yellow-400' : 'text-slate-300 dark:text-slate-600' }}" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                                @endfor
                            </div>
                            <span class="text-sm text-slate-500 dark:text-slate-400">{{ $item->rating }}/5</span>
                        </div>
                        
                        <!-- Komentar -->
                        @if($item->komentar)
                        <p class="text-slate-700 dark:text-slate-300 text-sm">{{ $item->komentar }}</p>
                        @else
                        <p class="text-slate-400 dark:text-slate-500 text-sm italic">Tanpa komentar</p>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center gap-2">
                        <a href="{{ route('pelanggan.pengaduan.show', $item->pengaduan->id) }}" class="p-2 text-slate-400 hover:text-yellow-500 transition-colors" title="Lihat Pengaduan">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
            {{ $feedback->links() }}
        </div>
        @endif
    </div>
</div>
@endsection