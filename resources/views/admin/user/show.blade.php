@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.users') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data User</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Detail User</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail User</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Informasi lengkap user</p>
    </div>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.data.users') }}" class="inline-flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Data User
        </a>
    </div>

    <!-- Profile Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        <!-- Header Banner -->
        <div class="h-32 bg-gradient-to-r from-yellow-400 to-yellow-600"></div>
        
        <!-- Profile Content -->
        <div class="px-6 pb-6">
            <!-- Avatar -->
            <div class="flex -mt-12 mb-4">
                <div class="w-24 h-24 rounded-full bg-white dark:bg-slate-700 border-4 border-white dark:border-slate-800 flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-yellow-500">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                </div>
            </div>

            <!-- Name & Status -->
            <div class="flex items-start justify-between flex-wrap gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</h2>
                    <p class="text-slate-500 dark:text-slate-400">{{ '@' . $user->username }}</p>
                </div>
                <div class="flex gap-2">
                    @php
                        $roleClasses = [
                            'admin' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
                            'petugas' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                            'pelanggan' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                        ];
                        $statusClasses = [
                            'aktif' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'nonaktif' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                        ];
                    @endphp
                    <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full {{ $roleClasses[$user->role] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                    <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full {{ $statusClasses[$user->status_akun] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300' }}">
                        {{ ucfirst($user->status_akun) }}
                    </span>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Email -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Email</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $user->email }}</p>
                </div>

                <!-- Username -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Username</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $user->username }}</p>
                </div>

                <!-- Tanggal Dibuat -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Tanggal Dibuat</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $user->created_at->format('d F Y, H:i') }}</p>
                </div>

                <!-- Terakhir Diperbarui -->
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Terakhir Diperbarui</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                <form action="{{ route('admin.data.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus User
                    </button>
                </form>
                <a href="{{ route('admin.data.users.edit', $user->id) }}" class="px-4 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit User
                </a>
            </div>
        </div>
    </div>
</div>
@endsection