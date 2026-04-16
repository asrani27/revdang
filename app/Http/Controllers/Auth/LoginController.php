<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to login with username as credentials
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'status_akun' => 'aktif'])) {
            $request->session()->regenerate();

            // Log login activity
            $user = Auth::user();
            $modul = match($user->role) {
                'admin' => 'admin',
                'petugas' => 'petugas',
                'pelanggan' => 'pelanggan',
                default => 'auth',
            };
            
            LogAktivitas::create([
                'user_id' => $user->id,
                'aktivitas' => "User {$user->name} ({$user->role}) berhasil login",
                'modul' => $modul,
                'IP_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Check user role and redirect accordingly
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'petugas') {
                return redirect()->intended(route('petugas.dashboard'));
            } elseif ($user->role === 'pelanggan') {
                return redirect()->intended(route('pelanggan.dashboard'));
            }
            
            // Default redirect if role not matched
            return redirect()->intended(route('admin.dashboard'));
        }

        // Login failed - log failed attempt if user exists
        $existingUser = \App\Models\User::where('username', $credentials['username'])->first();
        if ($existingUser) {
            LogAktivitas::create([
                'user_id' => $existingUser->id,
                'aktivitas' => "User {$existingUser->name} ({$existingUser->role}) gagal login - password salah",
                'modul' => 'auth',
                'IP_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        // Login failed
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->withInput($request->only('username', 'remember'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        
        // Log logout activity before logging out
        if ($user) {
            $modul = match($user->role) {
                'admin' => 'admin',
                'petugas' => 'petugas',
                'pelanggan' => 'pelanggan',
                default => 'auth',
            };
            
            LogAktivitas::create([
                'user_id' => $user->id,
                'aktivitas' => "User {$user->name} ({$user->role}) logout",
                'modul' => $modul,
                'IP_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('status', 'Anda telah berhasil logout.');
    }
}
