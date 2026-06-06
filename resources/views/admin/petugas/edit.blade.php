@extends('layouts.app')

@section('title', 'Edit Petugas')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.petugas') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Petugas</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Edit Petugas</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Petugas</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Perbarui data petugas</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.data.petugas.update', $petugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIK -->
                <div>
                    <label for="nik" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        NIK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik', $petugas->nik) }}" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('nik') border-red-500 @enderror"
                        placeholder="Masukkan NIK" required>
                    @error('nik')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $petugas->nama) }}" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                        placeholder="Masukkan nama lengkap" required>
                    @error('nama')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Jabatan <span class="text-red-500">*</span>
                    </label>
                    <select id="jabatan" name="jabatan" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('jabatan') border-red-500 @enderror" required>
                        <option value="">Pilih Jabatan</option>
                        <option value="Teknisi" {{ old('jabatan', $petugas->jabatan) == 'Teknisi' ? 'selected' : '' }}>Teknisi</option>
                        <option value="Supervisor" {{ old('jabatan', $petugas->jabatan) == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                        <option value="Koordinator" {{ old('jabatan', $petugas->jabatan) == 'Koordinator' ? 'selected' : '' }}>Koordinator</option>
                        <option value="Manager" {{ old('jabatan', $petugas->jabatan) == 'Manager' ? 'selected' : '' }}>Manager</option>
                    </select>
                    @error('jabatan')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Telepon -->
                <div>
                    <label for="telp" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        No. Telepon
                    </label>
                    <input type="text" id="telp" name="telp" value="{{ old('telp', $petugas->telp) }}" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                        placeholder="Masukkan nomor telepon">
                </div>
            </div>
            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.petugas') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">
                    Perbarui Petugas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection