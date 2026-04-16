@extends('layouts.app')

@section('title', 'Tambah Gangguan')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.gangguan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Gangguan</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Tambah Gangguan</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Gangguan Baru</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tambahkan data gangguan baru</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.data.gangguan.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <!-- Nama Gangguan -->
                <div>
                    <label for="nama_gangguan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Nama Gangguan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_gangguan" name="nama_gangguan" value="{{ old('nama_gangguan') }}" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('nama_gangguan') border-red-500 @enderror"
                        placeholder="Masukkan nama gangguan" required>
                    @error('nama_gangguan')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror"
                        placeholder="Masukkan deskripsi gangguan">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Deskripsi bersifat opsional. Tambahkan detail mengenai gangguan jika diperlukan.</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.gangguan') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">
                    Simpan Gangguan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection