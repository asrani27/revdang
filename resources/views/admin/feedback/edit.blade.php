@extends('layouts.app')

@section('title', 'Edit Feedback')

@section('content')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('admin.data.feedback') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Data Feedback</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 dark:text-white font-medium">Edit Feedback</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Feedback</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Perbarui data feedback</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.data.feedback.update', $feedback->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pengaduan -->
                <div class="md:col-span-2">
                    <label for="pengaduan_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <select id="pengaduan_id" name="pengaduan_id" 
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('pengaduan_id') border-red-500 @enderror" required>
                        <option value="">Pilih Pengaduan</option>
                        @foreach($pengaduan as $p)
                        <option value="{{ $p->id }}" {{ old('pengaduan_id', $feedback->pengaduan_id) == $p->id ? 'selected' : '' }}>
                            #{{ $p->id }} - {{ $p->pelanggan->nama ?? '-' }} ({{ $p->pelanggan->no_meter ?? '-' }})
                        </option>
                        @endforeach
                    </select>
                    @error('pengaduan_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rating -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Rating <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-4">
                        <div class="flex gap-1" id="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                            <button type="button" 
                                class="text-3xl text-slate-300 dark:text-slate-600 hover:text-yellow-400 transition-colors"
                                onclick="setRating({{ $i }})"
                                id="star-{{ $i }}">
                                ★
                            </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', $feedback->rating) }}">
                        <span class="text-sm text-slate-500 dark:text-slate-400" id="rating-text">Pilih rating</span>
                    </div>
                    @error('rating')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Komentar -->
            <div class="mt-6">
                <label for="komentar" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Komentar
                </label>
                <textarea id="komentar" name="komentar" rows="4" 
                    class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('komentar') border-red-500 @enderror"
                    placeholder="Masukkan komentar feedback">{{ old('komentar', $feedback->komentar) }}</textarea>
                @error('komentar')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.data.feedback') }}" class="px-6 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">
                    Perbarui Feedback
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function setRating(rating) {
        document.getElementById('rating-input').value = rating;
        
        // Update star colors
        for (let i = 1; i <= 5; i++) {
            const star = document.getElementById('star-' + i);
            if (i <= rating) {
                star.classList.remove('text-slate-300', 'dark:text-slate-600');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-slate-300', 'dark:text-slate-600');
            }
        }
        
        // Update text
        const ratingText = document.getElementById('rating-text');
        const ratingLabels = ['', 'Sangat Buruk', 'Buruk', 'Netral', 'Baik', 'Sangat Baik'];
        ratingText.textContent = ratingLabels[rating] || 'Pilih rating';
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const rating = document.getElementById('rating-input').value;
        if (rating > 0) {
            setRating(parseInt(rating));
        }
    });
</script>
@endpush
@endsection
