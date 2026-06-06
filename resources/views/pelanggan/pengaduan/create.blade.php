@extends('layouts.app')

@section('title', 'Buat Pengaduan - Pelanggan')

@section('content')
<!-- Page Header -->
<div class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 px-4 sm:px-2 py-4 lg:py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3">
            <a href="{{ route('pelanggan.pengaduan.index') }}" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Buat Pengaduan Baru</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Laporkan gangguan atau masalah yang Anda alami</p>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8 mx-auto max-w-3xl">
    @if($errors->any())
    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl">
        <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-400">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pelanggan.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Form Card -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="p-6 space-y-6">
                <!-- Kategori Gangguan -->
                <div>
                    <label for="gangguan_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Kategori Gangguan <span class="text-red-500">*</span>
                    </label>
                    <select id="gangguan_id" name="gangguan_id" required
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        <option value="">Pilih Kategori Gangguan</option>
                        @foreach($gangguan as $item)
                        <option value="{{ $item->id }}" {{ old('gangguan_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_gangguan }}
                        </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Pilih jenis gangguan yang Anda alami</p>
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required
                        placeholder="Contoh: Jl. Merdeka No. 123, RT 01 RW 02"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Tuliskan alamat lengkap lokasi gangguan</p>
                </div>

                <!-- Keluhan -->
                <div>
                    <label for="keluhan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Deskripsi Keluhan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="keluhan" name="keluhan" rows="5" required
                        placeholder="Jelaskan secara detail gangguan atau masalah yang Anda alami..."
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent resize-none">{{ old('keluhan') }}</textarea>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Jelaskan secara detail untuk mempercepat proses penanganan</p>
                </div>

                <!-- Foto -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Foto Bukti (Opsional)
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 dark:border-slate-600 border-dashed rounded-xl hover:border-yellow-500 transition-colors">
                        <div class="space-y-2 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-600 dark:text-slate-400 justify-center">
                                <label for="foto" class="relative cursor-pointer bg-white dark:bg-slate-700 rounded-md font-medium text-yellow-600 hover:text-yellow-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-yellow-500">
                                    <span>Upload file</span>
                                    <input id="foto" name="foto" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400">PNG, JPG, GIF maksimal 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-700/50 border-t border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('pelanggan.pengaduan.index') }}" class="px-6 py-2.5 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 font-medium rounded-xl transition-colors text-center">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-medium rounded-xl shadow-lg shadow-yellow-500/30 transition-all duration-200">
                    Kirim Pengaduan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Image preview
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Show preview if needed
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection