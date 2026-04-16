@extends('layouts.app')

@section('title', 'Edit Pengaduan')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.pengaduan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Pengaduan</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Edit Pengaduan</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Pengaduan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Perbarui data pengaduan</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.data.pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pelanggan -->
                <div>
                    <label for="pelanggan_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Pelanggan <span class="text-red-500">*</span>
                    </label>
                    <select id="pelanggan_id" name="pelanggan_id" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('pelanggan_id') border-red-500 @enderror" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ old('pelanggan_id', $pengaduan->pelanggan_id) == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }} - {{ $p->no_meter }}
                        </option>
                        @endforeach
                    </select>
                    @error('pelanggan_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gangguan -->
                <div>
                    <label for="gangguan_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Jenis Gangguan <span class="text-red-500">*</span>
                    </label>
                    <select id="gangguan_id" name="gangguan_id" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('gangguan_id') border-red-500 @enderror" required>
                        <option value="">Pilih Gangguan</option>
                        @foreach($gangguan as $g)
                        <option value="{{ $g->id }}" {{ old('gangguan_id', $pengaduan->gangguan_id) == $g->id ? 'selected' : '' }}>
                            {{ $g->nama_gangguan }}
                        </option>
                        @endforeach
                    </select>
                    @error('gangguan_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $pengaduan->tanggal) }}" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('tanggal') border-red-500 @enderror" required>
                    @error('tanggal')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('status') border-red-500 @enderror" required>
                        <option value="menunggu" {{ old('status', $pengaduan->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ old('status', $pengaduan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ old('status', $pengaduan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $pengaduan->lokasi) }}" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('lokasi') border-red-500 @enderror"
                        placeholder="Masukkan lokasi gangguan" required>
                    @error('lokasi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Foto Bukti
                    </label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('foto') border-red-500 @enderror">
                    @error('foto')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    @if($pengaduan->foto)
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Foto saat ini: {{ $pengaduan->foto }}</p>
                    @endif
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Maksimal 2MB, format: JPG, PNG</p>
                </div>
            </div>

            <!-- Keluhan -->
            <div class="mt-6">
                <label for="keluhan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Keluhan <span class="text-red-500">*</span>
                </label>
                <textarea id="keluhan" name="keluhan" rows="4" 
                    class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('keluhan') border-red-500 @enderror"
                    placeholder="Jelaskan keluhan pelanggan" required>{{ old('keluhan', $pengaduan->keluhan) }}</textarea>
                @error('keluhan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.pengaduan') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">
                    Perbarui Pengaduan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection