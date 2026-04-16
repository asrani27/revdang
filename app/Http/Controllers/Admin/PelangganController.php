<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    /**
     * Display a listing of the pelanggan.
     */
    public function index(Request $request)
    {
        $query = Pelanggan::with('user');

        // Search by nik, nama, or nomor_meter
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', '%' . $search . '%')
                  ->orWhere('nama', 'like', '%' . $search . '%')
                  ->orWhere('nomor_meter', 'like', '%' . $search . '%');
            });
        }

        // Order by latest
        $pelanggan = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new pelanggan.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created pelanggan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:16', 'unique:pelanggan,nik'],
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
            'telp' => ['nullable', 'string', 'max:15'],
            'daya' => ['required', 'string', 'max:20'],
            'nomor_meter' => ['required', 'string', 'max:20', 'unique:pelanggan,nomor_meter'],
        ]);

        // Create pelanggan (without user account)
        $pelanggan = Pelanggan::create([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'telp' => $validated['telp'] ?? null,
            'daya' => $validated['daya'],
            'nomor_meter' => $validated['nomor_meter'],
            'user_id' => null,
        ]);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah data pelanggan baru: {$pelanggan->nama} (Meter: {$pelanggan->nomor_meter})",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.pelanggan')
            ->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    /**
     * Display the specified pelanggan.
     */
    public function show(Pelanggan $pelanggan)
    {
        $pelanggan->load('user');
        return view('admin.pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified pelanggan.
     */
    public function edit(Pelanggan $pelanggan)
    {
        $pelanggan->load('user');
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified pelanggan in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:16', Rule::unique('pelanggan', 'nik')->ignore($pelanggan->id)],
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
            'telp' => ['nullable', 'string', 'max:15'],
            'daya' => ['required', 'string', 'max:20'],
            'nomor_meter' => ['required', 'string', 'max:20', Rule::unique('pelanggan', 'nomor_meter')->ignore($pelanggan->id)],
        ]);

        $pelanggan->nik = $validated['nik'];
        $pelanggan->nama = $validated['nama'];
        $pelanggan->alamat = $validated['alamat'];
        $pelanggan->telp = $validated['telp'] ?? null;
        $pelanggan->daya = $validated['daya'];
        $pelanggan->nomor_meter = $validated['nomor_meter'];
        $pelanggan->save();

        // Update user name if changed and user exists
        if ($pelanggan->user) {
            $pelanggan->user->name = $validated['nama'];
            $pelanggan->user->save();
        }

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Memperbarui data pelanggan: {$pelanggan->nama} (Meter: {$pelanggan->nomor_meter})",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.pelanggan')
            ->with('success', 'Pelanggan berhasil diperbarui!');
    }

    /**
     * Remove the specified pelanggan from storage.
     */
    public function destroy(Request $request, Pelanggan $pelanggan)
    {
        $pelangganNama = $pelanggan->nama;
        $pelangganMeter = $pelanggan->nomor_meter;
        
        // Delete associated user
        if ($pelanggan->user) {
            $pelanggan->user->delete();
        }
        $pelanggan->delete();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menghapus data pelanggan: {$pelangganNama} (Meter: {$pelangganMeter})",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.pelanggan')
            ->with('success', 'Pelanggan berhasil dihapus!');
    }

    /**
     * Create new user for existing pelanggan (auto-generate username and password)
     */
    public function createUser(Pelanggan $pelanggan)
    {
        if ($pelanggan->user_id) {
            return redirect()->route('admin.data.pelanggan')
                ->with('error', 'Pelanggan sudah memiliki akun!');
        }
        return view('admin.pelanggan.create-user', compact('pelanggan'));
    }

    /**
     * Store new user for pelanggan (auto: username = nomor_meter, password = "pelanggan")
     */
    public function storeUser(Request $request, Pelanggan $pelanggan)
    {
        if ($pelanggan->user_id) {
            return redirect()->route('admin.data.pelanggan')
                ->with('error', 'Pelanggan sudah memiliki akun!');
        }

        // Auto-generate username from nomor_meter and password
        $username = $pelanggan->nomor_meter;
        $password = 'pelanggan';

        // Check if username already exists
        $existingUser = User::where('username', $username)->first();
        if ($existingUser) {
            return redirect()->route('admin.data.pelanggan')
                ->with('error', 'Username sudah digunakan oleh user lain!');
        }

        // Create user with auto-generated credentials
        $user = User::create([
            'username' => $username,
            'name' => $pelanggan->nama,
            'email' => $pelanggan->nik . '@pelanggan.com', // Auto-generate email from NIK
            'password' => Hash::make($password),
            'role' => 'pelanggan',
            'status_akun' => 'aktif',
        ]);

        // Update pelanggan with user_id
        $pelanggan->user_id = $user->id;
        $pelanggan->save();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Membuat akun user untuk pelanggan: {$pelanggan->nama} (Meter: {$pelanggan->nomor_meter})",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.pelanggan')
            ->with('success', 'Akun user berhasil dibuat! Username: ' . $username . ', Password: pelanggan');
    }

    /**
     * Reset password for pelanggan user
     */
    public function resetPassword(Request $request, Pelanggan $pelanggan)
    {
        if (!$pelanggan->user_id) {
            return redirect()->route('admin.data.pelanggan')
                ->with('error', 'Pelanggan belum memiliki akun!');
        }

        $validated = $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $pelanggan->user->password = Hash::make($validated['password']);
        $pelanggan->user->save();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Mereset password pelanggan: {$pelanggan->nama}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.pelanggan')
            ->with('success', 'Password berhasil direset!');
    }

    /**
     * Show reset password form
     */
    public function showResetPassword(Pelanggan $pelanggan)
    {
        if (!$pelanggan->user_id) {
            return redirect()->route('admin.data.pelanggan')
                ->with('error', 'Pelanggan belum memiliki akun!');
        }
        return view('admin.pelanggan.reset-password', compact('pelanggan'));
    }
}
