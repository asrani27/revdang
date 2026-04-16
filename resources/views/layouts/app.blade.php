<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Dashboard - Aplikasi Pelayanan Pengaduan Gangguan Listrik">
    <title>@yield('title', 'Admin Dashboard') - PLN</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen bg-slate-100 dark:bg-slate-900 font-sans antialiased">
    
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 sticky top-0 z-40">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/30">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 3L4 14h7v7l9-11h-7V3z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-slate-900 dark:text-white text-sm">PLN Admin</h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Dashboard</p>
                </div>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-toggle" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                <svg id="menu-icon-open" class="w-6 h-6 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menu-icon-close" class="w-6 h-6 text-slate-600 dark:text-slate-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <nav id="mobile-nav" class="hidden border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
            <div class="p-4 space-y-1">
                @auth
                    @if(Auth::user()->role === 'admin')
                        @include('layouts.partials.menu_admin')
                    @elseif(Auth::user()->role === 'pelanggan')
                        @include('layouts.partials.menu_pelanggan')
                    @elseif(Auth::user()->role === 'petugas')
                        @include('layouts.partials.menu_petugas')
                    @endif
                @endauth
                
                <div class="pt-4 mt-4 border-t border-slate-200 dark:border-slate-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="font-medium">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="flex min-h-[calc(100vh-64px)] lg:min-h-screen">
        
        <!-- Sidebar - Desktop -->
        <aside id="sidebar" class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 z-30">
            
            <!-- Logo -->
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-200 dark:border-slate-700">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center shadow-lg shadow-yellow-500/30">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 3L4 14h7v7l9-11h-7V3z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-slate-900 dark:text-white">PLN Admin</h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400">PT. Banua Jaya Mandiri</p>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                @auth
                    @if(Auth::user()->role === 'admin')
                        @include('layouts.partials.menu_admin')
                    @elseif(Auth::user()->role === 'pelanggan')
                        @include('layouts.partials.menu_pelanggan')
                    @elseif(Auth::user()->role === 'petugas')
                        @include('layouts.partials.menu_petugas')
                    @endif
                @endauth
            </nav>
            
            <!-- User Profile & Logout -->
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                <div class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl bg-slate-50 dark:bg-slate-700">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 min-h-[calc(100vh-64px)] lg:min-h-screen">
            @yield('content')
        </main>
    </div>
    
    <!-- Mobile Menu Script -->
    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileNav = document.getElementById('mobile-nav');
        const menuIconOpen = document.getElementById('menu-icon-open');
        const menuIconClose = document.getElementById('menu-icon-close');
        
        mobileMenuToggle.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
            menuIconOpen.classList.toggle('hidden');
            menuIconClose.classList.toggle('hidden');
        });
    </script>
    
    @stack('scripts')
</body>
</html>
