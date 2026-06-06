<!-- Admin Menu Partial -->
<a href="{{ route('admin.dashboard') }}"
    class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700' }} transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
    </svg>
    <span class="font-medium">Dashboard</span>
</a>

<!-- Data Master -->
<div class="dropdown" x-data="{ open: false, isActive: false }">
    <button type="button" @click="open = !open"
        class="flex items-center justify-between gap-3 w-full px-4 py-3 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors"
        :class="isActive ? 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400' : ''">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span class="font-medium">Data Master</span>
        </div>
        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div x-show="open || isActive" x-transition class="pl-4 mt-1 space-y-1" x-cloak>
        <a href="{{ route('admin.data.users') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="users" data-url="/admin/data/users">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Data User</span>
        </a>
        <a href="{{ route('admin.data.petugas') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="petugas" data-url="/admin/data/petugas">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Data Petugas</span>
        </a>
        <a href="{{ route('admin.data.pelanggan') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="pelanggan" data-url="/admin/data/pelanggan">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Data Pelanggan</span>
        </a>
        <a href="{{ route('admin.data.gangguan') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="gangguan" data-url="/admin/data/gangguan">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Data Gangguan</span>
        </a>
        <a href="{{ route('admin.data.pengaduan') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="pengaduan" data-url="/admin/data/pengaduan">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Data Pengaduan</span>
        </a>
        <a href="{{ route('admin.data.penanganan') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="penanganan" data-url="/admin/data/penanganan">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Data Penanganan</span>
        </a>
        <a href="{{ route('admin.data.feedback') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="feedback" data-url="/admin/data/feedback">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Data Feedback</span>
        </a>
        <a href="{{ route('admin.data.log-aktivitas') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="log-aktivitas" data-url="/admin/data/log-aktivitas">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Log Aktivitas</span>
        </a>
    </div>
</div>

<!-- Laporan -->
<div class="dropdown" x-data="{ open: false, isActive: false }">
    <button type="button" @click="open = !open"
        class="flex items-center justify-between gap-3 w-full px-4 py-3 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors"
        :class="isActive ? 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400' : ''">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span class="font-medium">Laporan</span>
        </div>
        <svg class="w-4 h-4 transition-transform duration-200" :class="open || isActive ? 'rotate-180' : ''" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div x-show="open || isActive" x-transition class="pl-4 mt-1 space-y-1" x-cloak>
        <a href="{{ route('admin.laporan.user') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="laporan-user" data-url="/admin/laporan/user">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Lap User</span>
        </a>
        <a href="{{ route('admin.laporan.petugas') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="laporan-petugas" data-url="/admin/laporan/petugas">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Lap Petugas</span>
        </a>
        <a href="{{ route('admin.laporan.pelanggan') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="laporan-pelanggan" data-url="/admin/laporan/pelanggan">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Lap Pelanggan</span>
        </a>
        <a href="{{ route('admin.laporan.gangguan') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="laporan-gangguan" data-url="/admin/laporan/gangguan">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Lap Gangguan</span>
        </a>
        <a href="{{ route('admin.laporan.pengaduan') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="laporan-pengaduan" data-url="/admin/laporan/pengaduan">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Lap Pengaduan</span>
        </a>
        <a href="{{ route('admin.laporan.penanganan') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="laporan-penanganan" data-url="/admin/laporan/penanganan">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Lap Penanganan</span>
        </a>
        <a href="{{ route('admin.laporan.feedback') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="laporan-feedback" data-url="/admin/laporan/feedback">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Lap Feedback</span>
        </a>
        <a href="{{ route('admin.laporan.log-aktivitas') }}"
            class="menu-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm"
            data-menu="laporan-log-aktivitas" data-url="/admin/laporan/log-aktivitas">
            <span class="w-1 h-1 rounded-full bg-current"></span>
            <span>Lap Log Aktivitas</span>
        </a>
    </div>
</div>

<!-- JavaScript for Dynamic Menu Highlighting -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get current URL path
        var currentPath = window.location.pathname;
        
        // Get all menu items
        var menuItems = document.querySelectorAll('.menu-item[data-url]');
        
        // Loop through each menu item
        menuItems.forEach(function(item) {
            var menuUrl = item.getAttribute('data-url');
            
            // Check if current path matches the menu URL (exact match or nested routes)
            if (currentPath === menuUrl || currentPath.startsWith(menuUrl + '/')) {
                // Set active state
                item.classList.remove('text-slate-500', 'dark:text-slate-400', 'hover:bg-slate-50', 'dark:hover:bg-slate-700');
                item.classList.add('bg-yellow-50', 'dark:bg-yellow-900/20', 'text-yellow-600', 'dark:text-yellow-400');
                
                // Open parent dropdown by dispatching custom event
                var dropdown = item.closest('.dropdown');
                if (dropdown) {
                    dropdown.dispatchEvent(new CustomEvent('activate-dropdown'));
                }
            }
        });
        
        // Listen for activate-dropdown event on all dropdowns
        document.querySelectorAll('.dropdown').forEach(function(dropdown) {
            dropdown.addEventListener('activate-dropdown', function() {
                var button = this.querySelector('button');
                if (button) {
                    button.click();
                }
            });
        });
    });
</script>
