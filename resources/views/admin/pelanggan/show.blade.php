@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="p-6">
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li><a href="{{ route('admin.data.pelanggan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Pelanggan</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Detail Pelanggan</li>
        </ol>
    </nav>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Pelanggan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Informasi lengkap pelanggan</p>
    </div>

    <div class="mb-6">
        <a href="{{ route('admin.data.pelanggan') }}" class="inline-flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Data Pelanggan
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-green-400 to-green-600"></div>
        <div class="px-6 pb-6">
            <div class="flex -mt-12 mb-4">
                <div class="w-24 h-24 rounded-full bg-white dark:bg-slate-700 border-4 border-white dark:border-slate-800 flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-green-500">{{ strtoupper(substr($pelanggan->nama, 0, 1)) }}</span>
                </div>
            </div>

            <div class="flex items-start justify-between flex-wrap gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $pelanggan->nama }}</h2>
                    <p class="text-slate-500 dark:text-slate-400">NIK: {{ $pelanggan->nik }}</p>
                </div>
                <div class="flex gap-2">
                    <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">{{ $pelanggan->daya }} VA</span>
                    @if($pelanggan->user_id)
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Akun Aktif</span>
                    @else
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">Tanpa Akun</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center"><svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg></div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">NIK</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pelanggan->nik }}</p>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center"><svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg></div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Nomor Meter</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pelanggan->nomor_meter }}</p>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center"><svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Telepon</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pelanggan->telp ?? '-' }}</p>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center"><svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Daya</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pelanggan->daya }} VA</p>
                </div>
                <div class="md:col-span-2 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-900/30 flex items-center justify-center"><svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Alamat</span>
                    </div>
                    <p class="text-slate-900 dark:text-white font-medium">{{ $pelanggan->alamat }}</p>
                </div>
            </div>

            @if($pelanggan->user)
            <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                <h4 class="text-sm font-semibold text-green-700 dark:text-green-400 mb-3">Informasi Akun User</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div><label class="block text-xs text-slate-500 dark:text-slate-400 mb-1">Username</label><p class="text-slate-900 dark:text-white font-medium">{{ $pelanggan->user->username }}</p></div>
                    <div><label class="block text-xs text-slate-500 dark:text-slate-400 mb-1">Email</label><p class="text-slate-900 dark:text-white font-medium">{{ $pelanggan->user->email }}</p></div>
                    <div><label class="block text-xs text-slate-500 dark:text-slate-400 mb-1">Status</label><span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">{{ ucfirst($pelanggan->user->status_akun) }}</span></div>
                </div>
            </div>
            @endif

            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                @if(!$pelanggan->user_id)
                <a href="{{ route('admin.data.pelanggan.create-user', $pelanggan->id) }}" class="px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>Buat Akun
                </a>
                @else
                <a href="{{ route('admin.data.pelanggan.reset-password.show', $pelanggan->id) }}" class="px-4 py-2.5 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>Reset Password
                </a>
                @endif
                <a href="{{ route('admin.data.pelanggan.edit', $pelanggan->id) }}" class="px-4 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection