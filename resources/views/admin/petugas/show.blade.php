@extends('layouts.app')

@section('title', 'Detail Petugas')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.petugas') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Petugas</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Detail Petugas</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Petugas</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Informasi lengkap petugas</p>
    </div>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.data.petugas') }}" class="inline-flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Data Petugas
        </a>
    </div>

    <!-- Profile Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        <!-- Header Banner -->
        <div class="h-32 bg-gradient-to-r from-blue-400 to-blue-600"></div>
        
        <!-- Profile Content -->
        <div class="px-6 pb-6">
            <!-- Avatar -->
            <div class="flex -mt-12 mb-4">
                <div class="w-24 h-24 rounded-full bg-white dark:bg-slate-700 border-4 border-white dark:border-slate-800 flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-blue-500">
                        {{ strtoupper(substr($petugas->nama, 0, 1)) }}
                    </span>
                </div>
            </div>

            <!-- Name & Status -->
            <div class="flex items-start justify-between flex-wrap gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $petugas->nama }}</h2>
                    <p class="text-slate-500 dark:text-slate-400">NIK: {{ $petugas->nik }}</p>
                </div>
                <div class="flex gap-2">
                    <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                        {{ $petugas->jabatan }}
                    </span>
                    @if($petugas->user_id)
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                            Akun Aktif
                        </span>
                    @else
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                            Tanpa Akun
                        </span>
                    @endif
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIK -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">NIK</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $petugas->nik }}</p>
                </div>

                <!-- Jabatan -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Jabatan</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $petugas->jabatan }}</p>
                </div>

                <!-- Telepon -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Telepon</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $petugas->telp ?? '-' }}</p>
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
                    <p class="text-slate-900 dark:text-white font-medium">{{ $petugas->created_at->format('d F Y') }}</p>
                </div>
            </div>

            <!-- User Account Info -->
            @if($petugas->user)
            <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                <h4 class="text-sm font-semibold text-green-700 dark:text-green-400 mb-3">Informasi Akun User</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs text-slate-500 dark:text-slate-400 mb-1">Username</label>
                        <p class="text-slate-900 dark:text-white font-medium">{{ $petugas->user->username }}</p>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-500 dark:text-slate-400 mb-1">Email</label>
                        <p class="text-slate-900 dark:text-white font-medium">{{ $petugas->user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-500 dark:text-slate-400 mb-1">Status</label>
                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                            {{ ucfirst($petugas->user->status_akun) }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                @if(!$petugas->user_id)
                <a href="{{ route('admin.data.petugas.create-user', $petugas->id) }}" class="px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Buat Akun
                </a>
                @else
                <a href="{{ route('admin.data.petugas.reset-password', $petugas->id) }}" class="px-4 py-2.5 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Reset Password
                </a>
                @endif
                <a href="{{ route('admin.data.petugas.edit', $petugas->id) }}" class="px-4 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
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