@extends('layouts.app')

@section('title', 'Edit Penanganan')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.penanganan') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Penanganan</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Edit Penanganan</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Penanganan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Perbarui data penanganan pengaduan</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.data.penanganan.update', $penanganan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pengaduan -->
                <div>
                    <label for="pengaduan_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <select id="pengaduan_id" name="pengaduan_id" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('pengaduan_id') border-red-500 @enderror" required>
                        <option value="">Pilih Pengaduan</option>
                        @foreach($pengaduan as $p)
                        <option value="{{ $p->id }}" {{ old('pengaduan_id', $penanganan->pengaduan_id) == $p->id ? 'selected' : '' }}>
                            {{ $p->tanggal->format('d M Y') }} - {{ Str::limit($p->keluhan, 50) }}
                        </option>
                        @endforeach
                    </select>
                    @error('pengaduan_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Petugas -->
                <div>
                    <label for="petugas_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Petugas <span class="text-red-500">*</span>
                    </label>
                    <select id="petugas_id" name="petugas_id" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('petugas_id') border-red-500 @enderror" required>
                        <option value="">Pilih Petugas</option>
                        @foreach($petugas as $pt)
                        <option value="{{ $pt->id }}" {{ old('petugas_id', $penanganan->petugas_id) == $pt->id ? 'selected' : '' }}>
                            {{ $pt->nama }} - {{ $pt->no_telepon }}
                        </option>
                        @endforeach
                    </select>
                    @error('petugas_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $penanganan->tanggal) }}" 
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
                        <option value="pending" {{ old('status', $penanganan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ old('status', $penanganan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ old('status', $penanganan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Biaya -->
                <div>
                    <label for="biaya_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Biaya
                    </label>
                    <select id="biaya_id" name="biaya_id" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('biaya_id') border-red-500 @enderror">
                        <option value="">Pilih Biaya (Opsional)</option>
                        @foreach($biaya as $b)
                        <option value="{{ $b->id }}" {{ old('biaya_id', $penanganan->biaya_id) == $b->id ? 'selected' : '' }}>
                            {{ $b->kode }} - {{ $b->nama }} (Rp {{ number_format($b->jumlah, 0, ',', '.') }})
                        </option>
                        @endforeach
                    </select>
                    @error('biaya_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tindakan -->
            <div class="mt-6">
                <label for="tindakan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Tindakan <span class="text-red-500">*</span>
                </label>
                <textarea id="tindakan" name="tindakan" rows="4" 
                    class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('tindakan') border-red-500 @enderror"
                    placeholder="Jelaskan tindakan yang dilakukan" required>{{ old('tindakan', $penanganan->tindakan) }}</textarea>
                @error('tindakan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Hasil -->
            <div class="mt-6">
                <label for="hasil" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Hasil <span class="text-red-500">*</span>
                </label>
                <textarea id="hasil" name="hasil" rows="4" 
                    class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('hasil') border-red-500 @enderror"
                    placeholder="Jelaskan hasil penanganan" required>{{ old('hasil', $penanganan->hasil) }}</textarea>
                @error('hasil')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.penanganan') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">
                    Perbarui Penanganan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection