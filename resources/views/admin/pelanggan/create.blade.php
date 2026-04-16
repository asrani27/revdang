@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="p-6">
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li><a href="{{ route('admin.data.pelanggan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Pelanggan</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Tambah Pelanggan</li>
        </ol>
    </nav>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Pelanggan Baru</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tambahkan data pelanggan baru</p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.data.pelanggan.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nik" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik') }}" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white @error('nik') border-red-500 @enderror" placeholder="Masukkan NIK" required>
                    @error('nik')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="nama" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white @error('nama') border-red-500 @enderror" placeholder="Masukkan nama lengkap" required>
                    @error('nama')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Alamat <span class="text-red-500">*</span></label>
                    <textarea id="alamat" name="alamat" rows="3" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white @error('alamat') border-red-500 @enderror" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                    @error('alamat')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="telp" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">No. Telepon</label>
                    <input type="text" id="telp" name="telp" value="{{ old('telp') }}" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white" placeholder="Masukkan nomor telepon">
                </div>
                <div>
                    <label for="daya" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Daya (VA) <span class="text-red-500">*</span></label>
                    <select id="daya" name="daya" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white @error('daya') border-red-500 @enderror" required>
                        <option value="">Pilih Daya</option>
                        <option value="450" {{ old('daya') == '450' ? 'selected' : '' }}>450 VA</option>
                        <option value="900" {{ old('daya') == '900' ? 'selected' : '' }}>900 VA</option>
                        <option value="1300" {{ old('daya') == '1300' ? 'selected' : '' }}>1.300 VA</option>
                        <option value="2200" {{ old('daya') == '2200' ? 'selected' : '' }}>2.200 VA</option>
                        <option value="3500" {{ old('daya') == '3500' ? 'selected' : '' }}>3.500 VA</option>
                        <option value="5500" {{ old('daya') == '5500' ? 'selected' : '' }}>5.500 VA</option>
                    </select>
                    @error('daya')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="nomor_meter" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nomor Meter <span class="text-red-500">*</span></label>
                    <input type="text" id="nomor_meter" name="nomor_meter" value="{{ old('nomor_meter') }}" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white @error('nomor_meter') border-red-500 @enderror" placeholder="Masukkan nomor meter" required>
                    @error('nomor_meter')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.pelanggan') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">Simpan Pelanggan</button>
            </div>
        </form>
    </div>
</div>
@endsection