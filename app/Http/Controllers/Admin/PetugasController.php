<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    /**
     * Display a listing of the petugas.
     */
    public function index(Request $request)
    {
        $query = Petugas::with('user');

        // Search by nik, nama, or jabatan
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('jabatan', 'like', '%' . $search . '%');
            });
        }

        // Filter by jabatan
        if ($request->has('jabatan') && $request->jabatan !== '') {
            $query->where('jabatan', $request->jabatan);
        }

        // Order by latest
        $petugas = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.petugas.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new petugas.
     */
    public function create()
    {
        return view('admin.petugas.create');
    }

    /**
     * Store a newly created petugas in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:16', 'unique:petugas,nik'],
            'nama' => ['required', 'string', 'max:100'],
            'jabatan' => ['required', 'string', 'max:50'],
            'telp' => ['nullable', 'string', 'max:15'],
        ]);

        // Create user with NIK as username and "petugas" as password
        $user = User::create([
            'username' => $validated['nik'],
            'name' => $validated['nama'],
            'email' => $validated['nik'] . '@petugas.com',
            'password' => Hash::make('petugas'),
            'role' => 'petugas',
            'status_akun' => 'aktif',
        ]);

        // Create petugas with user_id
        $petugas = Petugas::create([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'telp' => $validated['telp'] ?? null,
            'user_id' => $user->id,
        ]);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah data petugas baru: {$petugas->nama} ({$petugas->jabatan})",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.petugas')
            ->with('success', "Petugas berhasil ditambahkan! Username: {$petugas->nik}, Password: petugas");
    }

    /**
     * Display the specified petugas.
     */
    public function show(Petugas $petugas)
    {
        $petugas->load('user');
        return view('admin.petugas.show', compact('petugas'));
    }

    /**
     * Show the form for editing the specified petugas.
     */
    public function edit(Petugas $petugas)
    {
        $petugas->load('user');
        return view('admin.petugas.edit', compact('petugas'));
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, Petugas $petugas)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:16', Rule::unique('petugas', 'nik')->ignore($petugas->id)],
            'nama' => ['required', 'string', 'max:100'],
            'jabatan' => ['required', 'string', 'max:50'],
            'telp' => ['nullable', 'string', 'max:15'],
        ]);

        $petugas->nik = $validated['nik'];
        $petugas->nama = $validated['nama'];
        $petugas->jabatan = $validated['jabatan'];
        $petugas->telp = $validated['telp'] ?? null;
        $petugas->save();

        // Update user name if changed
        if ($petugas->user) {
            $petugas->user->name = $validated['nama'];
            $petugas->user->save();
        }

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Memperbarui data petugas: {$petugas->nama} ({$petugas->jabatan})",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.petugas')
            ->with('success', 'Petugas berhasil diperbarui!');
    }

    /**
     * Remove the specified petugas from storage.
     */
    public function destroy(Request $request, Petugas $petugas)
    {
        $petugasNama = $petugas->nama;
        $petugasJabatan = $petugas->jabatan;
        
        // Delete associated user
        if ($petugas->user) {
            $petugas->user->delete();
        }
        $petugas->delete();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menghapus data petugas: {$petugasNama} ({$petugasJabatan})",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.petugas')
            ->with('success', 'Petugas berhasil dihapus!');
    }

    /**
     * Create new user for existing petugas
     */
    public function createUser(Petugas $petugas)
    {
        if ($petugas->user_id) {
            return redirect()->route('admin.data.petugas')
                ->with('error', 'Petugas sudah memiliki akun!');
        }
        return view('admin.petugas.create-user', compact('petugas'));
    }

    /**
     * Store new user for petugas
     */
    public function storeUser(Request $request, Petugas $petugas)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'name' => $petugas->nama,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'petugas',
            'status_akun' => 'aktif',
        ]);

        $petugas->user_id = $user->id;
        $petugas->save();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Membuat akun user untuk petugas: {$petugas->nama}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.petugas')
            ->with('success', 'Akun user berhasil dibuat!');
    }

    /**
     * Show reset password form
     */
    public function showResetPassword(Petugas $petugas)
    {
        if (!$petugas->user_id) {
            return redirect()->route('admin.data.petugas')
                ->with('error', 'Petugas belum memiliki akun!');
        }
        return view('admin.petugas.reset-password', compact('petugas'));
    }

    /**
     * Reset password for petugas user
     */
    public function resetPassword(Request $request, Petugas $petugas)
    {
        if (!$petugas->user_id) {
            return redirect()->route('admin.data.petugas')
                ->with('error', 'Petugas belum memiliki akun!');
        }

        $validated = $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $petugas->user->password = Hash::make($validated['password']);
        $petugas->user->save();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Mereset password petugas: {$petugas->nama}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.petugas')
            ->with('success', 'Password berhasil direset!');
    }
}