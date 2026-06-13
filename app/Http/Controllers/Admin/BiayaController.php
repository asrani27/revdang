<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    /**
     * Display a listing of the biaya.
     */
    public function index(Request $request)
    {
        $query = Biaya::query();

        // Search by kode, nama, or keterangan
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        }

        // Order by latest
        $biaya = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.biaya.index', compact('biaya'));
    }

    /**
     * Show the form for creating a new biaya.
     */
    public function create()
    {
        return view('admin.biaya.create');
    }

    /**
     * Store a newly created biaya in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:20', 'unique:biaya,kode'],
            'nama' => ['required', 'string', 'max:100'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $biaya = Biaya::create($validated);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah data biaya baru: {$biaya->nama}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.biaya')
            ->with('success', 'Data Biaya berhasil ditambahkan!');
    }

    /**
     * Display the specified biaya.
     */
    public function show(Biaya $biaya)
    {
        return view('admin.biaya.show', compact('biaya'));
    }

    /**
     * Show the form for editing the specified biaya.
     */
    public function edit(Biaya $biaya)
    {
        return view('admin.biaya.edit', compact('biaya'));
    }

    /**
     * Update the specified biaya in storage.
     */
    public function update(Request $request, Biaya $biaya)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:20', 'unique:biaya,kode,' . $biaya->id],
            'nama' => ['required', 'string', 'max:100'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $biaya->kode = $validated['kode'];
        $biaya->nama = $validated['nama'];
        $biaya->jumlah = $validated['jumlah'];
        $biaya->keterangan = $validated['keterangan'] ?? null;
        $biaya->save();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Memperbarui data biaya: {$biaya->nama}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.biaya')
            ->with('success', 'Data Biaya berhasil diperbarui!');
    }

    /**
     * Remove the specified biaya from storage.
     */
    public function destroy(Request $request, Biaya $biaya)
    {
        $biayaNama = $biaya->nama;
        $biaya->delete();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menghapus data biaya: {$biayaNama}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.biaya')
            ->with('success', 'Data Biaya berhasil dihapus!');
    }
}
