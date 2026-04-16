@extends('layouts.app')

@section('title', 'Detail Log Aktivitas')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.data.log-aktivitas') }}" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Log Aktivitas</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">ID: #{{ $logAktivitas->id }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- User Info -->
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informasi User
            </h2>
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                        <span class="text-2xl font-bold text-slate-600 dark:text-slate-300">
                            {{ strtoupper(substr($logAktivitas->user->name ?? '-', 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $logAktivitas->user->name ?? '-' }}</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $logAktivitas->user->email ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Username</p>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $logAktivitas->user->username ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Role</p>
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $logAktivitas->role_badge_color }}">
                            {{ $logAktivitas->role_label }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Info -->
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Detail Aktivitas
            </h2>
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Aktivitas</p>
                    <div class="flex items-center gap-2">
                        {!! $logAktivitas->activity_icon !!}
                        <p class="text-base font-medium text-slate-900 dark:text-white">{{ $logAktivitas->aktivitas }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Modul</p>
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium mt-1
                            {{ $logAktivitas->modul === 'admin' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400' : 
                               ($logAktivitas->modul === 'petugas' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 
                               ($logAktivitas->modul === 'pelanggan' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 
                               'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300')) }}">
                            {{ ucfirst($logAktivitas->modul ?? 'general') }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">IP Address</p>
                        <p class="text-sm font-medium text-slate-900 dark:text-white font-mono mt-1">{{ $logAktivitas->IP_address ?? '-' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal</p>
                        <p class="text-sm font-medium text-slate-900 dark:text-white mt-1">{{ $logAktivitas->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Waktu</p>
                        <p class="text-sm font-medium text-slate-900 dark:text-white mt-1">{{ $logAktivitas->created_at->format('H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technical Info -->
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6 lg:col-span-2">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Informasi Teknis
            </h2>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">User Agent</p>
                <p class="text-sm font-mono text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-700 rounded-lg p-3 break-all">
                    {{ $logAktivitas->user_agent ?? '-' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
