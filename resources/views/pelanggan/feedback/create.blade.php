@extends('layouts.app')

@section('title', 'Beri Feedback - Pelanggan')

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
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Beri Feedback</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Berikan penilaian dan komentar untuk layanan kami</p>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8 mx-auto max-w-2xl">
    @if($errors->any())
    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl">
        <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-400">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl">
        <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl">
        <p class="text-red-700 dark:text-red-400">{{ session('error') }}</p>
    </div>
    @endif

    @if($pengaduanList->isEmpty() && !$selectedPengaduan)
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm p-12 text-center">
        <svg class="w-20 h-20 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-2">Tidak Ada Pengaduan untuk Diberi Feedback</h3>
        <p class="text-slate-500 dark:text-slate-400 mb-4">Pengaduan yang sudah selesai dan belum diberi feedback akan muncul di sini</p>
        <a href="{{ route('pelanggan.pengaduan.index') }}" class="inline-flex items-center gap-2 text-yellow-600 dark:text-yellow-400 hover:text-yellow-700">
            ← Kembali ke Daftar Pengaduan
        </a>
    </div>
    @else
    <form action="{{ route('pelanggan.feedback.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Form Card -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="p-6 space-y-6">
                <!-- Select Pengaduan -->
                <div>
                    <label for="pengaduan_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Pilih Pengaduan <span class="text-red-500">*</span>
                    </label>
                    @if($selectedPengaduan)
                    <input type="hidden" name="pengaduan_id" value="{{ $selectedPengaduan->id }}">
                    <div class="p-4 bg-slate-50 dark:bg-slate-700 rounded-xl border border-slate-200 dark:border-slate-600">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">#PND-{{ str_pad($selectedPengaduan->id, 4, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $selectedPengaduan->gangguan->nama_gangguan ?? 'N/A' }}</p>
                            </div>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    @else
                    <select id="pengaduan_id" name="pengaduan_id" required
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        <option value="">Pilih Pengaduan</option>
                        @foreach($pengaduanList as $item)
                        <option value="{{ $item->id }}" {{ old('pengaduan_id') == $item->id ? 'selected' : '' }}>
                            #PND-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }} - {{ $item->gangguan->nama_gangguan ?? 'N/A' }} ({{ $item->tanggal->format('d M Y') }})
                        </option>
                        @endforeach
                    </select>
                    @endif
                </div>

                <!-- Rating -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">
                        Rating <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-2" id="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" onclick="setRating({{ $i }})" 
                            class="star-btn p-1 transition-transform hover:scale-110 focus:outline-none"
                            data-rating="{{ $i }}">
                            <svg class="w-10 h-10 text-slate-300 dark:text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-input" value="{{ old('rating') }}">
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400" id="rating-text">Klik untuk memberikan rating</p>
                </div>

                <!-- Komentar -->
                <div>
                    <label for="komentar" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Komentar (Opsional)
                    </label>
                    <textarea id="komentar" name="komentar" rows="4"
                        placeholder="Berikan komentar atau saran untuk meningkatkan layanan kami..."
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent resize-none">{{ old('komentar') }}</textarea>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Komentar Anda sangat berarti untuk meningkatkan kualitas layanan</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-700/50 border-t border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('pelanggan.pengaduan.index') }}" class="px-6 py-2.5 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 font-medium rounded-xl transition-colors text-center">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-medium rounded-xl shadow-lg shadow-yellow-500/30 transition-all duration-200">
                    Kirim Feedback
                </button>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection

@push('scripts')
<script>
    let currentRating = parseInt('{{ old('rating') }}') || 0;
    
    function setRating(rating) {
        currentRating = rating;
        document.getElementById('rating-input').value = rating;
        
        const stars = document.querySelectorAll('.star-btn');
        const ratingTexts = {
            1: 'Sangat Buruk',
            2: 'Buruk',
            3: 'Cukup',
            4: 'Baik',
            5: 'Sangat Baik'
        };
        
        stars.forEach((star, index) => {
            const svg = star.querySelector('svg');
            if (index < rating) {
                svg.classList.remove('text-slate-300', 'dark:text-slate-600');
                svg.classList.add('text-yellow-400');
            } else {
                svg.classList.remove('text-yellow-400');
                svg.classList.add('text-slate-300', 'dark:text-slate-600');
            }
        });
        
        document.getElementById('rating-text').textContent = ratingTexts[rating] || 'Klik untuk memberikan rating';
    }
    
    // Initialize rating on page load
    if (currentRating > 0) {
        setRating(currentRating);
    }
</script>
@endpush
