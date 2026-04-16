<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gangguan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class GangguanController extends Controller
{
    /**
     * Display a listing of the gangguan.
     */
    public function index(Request $request)
    {
        $query = Gangguan::query();

        // Search by nama_gangguan or deskripsi
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_gangguan', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Order by latest
        $gangguan = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.gangguan.index', compact('gangguan'));
    }

    /**
     * Show the form for creating a new gangguan.
     */
    public function create()
    {
        return view('admin.gangguan.create');
    }

    /**
     * Store a newly created gangguan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gangguan' => ['required', 'string', 'max:100', 'unique:gangguan,nama_gangguan'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $gangguan = Gangguan::create($validated);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah data gangguan baru: {$gangguan->nama_gangguan}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.gangguan')
            ->with('success', 'Data Gangguan berhasil ditambahkan!');
    }

    /**
     * Display the specified gangguan.
     */
    public function show(Gangguan $gangguan)
    {
        return view('admin.gangguan.show', compact('gangguan'));
    }

    /**
     * Show the form for editing the specified gangguan.
     */
    public function edit(Gangguan $gangguan)
    {
        return view('admin.gangguan.edit', compact('gangguan'));
    }

    /**
     * Update the specified gangguan in storage.
     */
    public function update(Request $request, Gangguan $gangguan)
    {
        $validated = $request->validate([
            'nama_gangguan' => ['required', 'string', 'max:100', 'unique:gangguan,nama_gangguan,' . $gangguan->id],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $gangguan->nama_gangguan = $validated['nama_gangguan'];
        $gangguan->deskripsi = $validated['deskripsi'] ?? null;
        $gangguan->save();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Memperbarui data gangguan: {$gangguan->nama_gangguan}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.gangguan')
            ->with('success', 'Data Gangguan berhasil diperbarui!');
    }

    /**
     * Remove the specified gangguan from storage.
     */
    public function destroy(Request $request, Gangguan $gangguan)
    {
        $gangguanNama = $gangguan->nama_gangguan;
        $gangguan->delete();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menghapus data gangguan: {$gangguanNama}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.gangguan')
            ->with('success', 'Data Gangguan berhasil dihapus!');
    }
}
