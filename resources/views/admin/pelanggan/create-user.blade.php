@extends('layouts.app')

@section('title', 'Buat Akun Pelanggan')

@section('content')
<div class="p-6">
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li><a href="{{ route('admin.data.pelanggan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Pelanggan</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Buat Akun</li>
        </ol>
    </nav>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Buat Akun User</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Buat akun user untuk pelanggan: {{ $pelanggan->nama }}</p>
    </div>

    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm text-blue-700 dark:text-blue-400">Akun akan dibuat secara otomatis dengan username = <strong>{{ $pelanggan->nomor_meter }}</strong> dan password = <strong>pelanggan</strong></p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <div class="mb-6 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
            <h4 class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Informasi Pelanggan</h4>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-slate-500 dark:text-slate-400">Nama:</span>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $pelanggan->nama }}</p>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400">NIK:</span>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $pelanggan->nik }}</p>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400">Nomor Meter:</span>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $pelanggan->nomor_meter }}</p>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400">Daya:</span>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $pelanggan->daya }} VA</p>
                </div>
            </div>
        </div>

        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <h4 class="text-sm font-medium text-green-700 dark:text-green-400 mb-3">Detail Akun yang akan dibuat</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-slate-500 dark:text-slate-400">Username:</span>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $pelanggan->nomor_meter }}</p>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400">Password:</span>
                    <p class="font-semibold text-slate-900 dark:text-white">pelanggan</p>
                </div>
                <div class="md:col-span-2">
                    <span class="text-slate-500 dark:text-slate-400">Email:</span>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $pelanggan->nik }}@pelanggan.com</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.data.pelanggan.store-user', $pelanggan->id) }}" method="POST">
            @csrf
            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.pelanggan') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors text-sm font-medium">Buat Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection