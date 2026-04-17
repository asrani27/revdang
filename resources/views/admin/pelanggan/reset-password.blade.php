@extends('layouts.app')

@section('title', 'Reset Password Pelanggan')

@section('content')
<div class="p-6">
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li><a href="{{ route('admin.data.pelanggan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Pelanggan</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Reset Password</li>
        </ol>
    </nav>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Reset Password</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Reset password untuk pelanggan: {{ $pelanggan->nama }}</p>
    </div>

    <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                <span class="text-sm font-semibold text-purple-600 dark:text-purple-400">{{ strtoupper(substr($pelanggan->nama, 0, 1)) }}</span>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $pelanggan->nama }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $pelanggan->user->username }} | {{ $pelanggan->user->email }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.data.pelanggan.reset-password.update', $pelanggan->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Password Baru <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white @error('password') border-red-500 @enderror" placeholder="Minimal 8 karakter" required>
                    @error('password')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white" placeholder="Ulangi password" required>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.pelanggan') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors text-sm font-medium">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection