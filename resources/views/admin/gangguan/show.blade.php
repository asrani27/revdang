@extends('layouts.app')

@section('title', 'Detail Gangguan')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.gangguan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Gangguan</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Detail Gangguan</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Gangguan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Informasi lengkap gangguan</p>
    </div>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.data.gangguan') }}" class="inline-flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Data Gangguan
        </a>
    </div>

    <!-- Profile Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        <!-- Header Banner -->
        <div class="h-32 bg-gradient-to-r from-red-400 to-red-600"></div>
        
        <!-- Profile Content -->
        <div class="px-6 pb-6">
            <!-- Avatar -->
            <div class="flex -mt-12 mb-4">
                <div class="w-24 h-24 rounded-full bg-white dark:bg-slate-700 border-4 border-white dark:border-slate-800 flex items-center justify-center shadow-lg">
                    <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>

            <!-- Name & Status -->
            <div class="flex items-start justify-between flex-wrap gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $gangguan->nama_gangguan }}</h2>
                    <p class="text-slate-500 dark:text-slate-400">ID: #{{ $gangguan->id }}</p>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Gangguan -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Nama Gangguan</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $gangguan->nama_gangguan }}</p>
                </div>

                <!-- Tanggal Dibuat -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Tanggal Dibuat</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $gangguan->created_at->format('d F Y') }}</p>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Deskripsi</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $gangguan->deskripsi ?? '-' }}</p>
                </div>

                <!-- Terakhir Diperbarui -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Terakhir Diperbarui</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $gangguan->updated_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.gangguan.edit', $gangguan->id) }}" class="px-4 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection