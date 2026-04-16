<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penanganan;
use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class PenangananController extends Controller
{
    /**
     * Display a listing of the penanganan.
     */
    public function index(Request $request)
    {
        $query = Penanganan::with(['pengaduan', 'petugas']);

        // Search by pengaduan, petugas name, or tindakan
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pengaduan', function ($pq) use ($search) {
                    $pq->where('keluhan', 'like', '%' . $search . '%');
                })
                ->orWhereHas('petugas', function ($tq) use ($search) {
                    $tq->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhere('tindakan', 'like', '%' . $search . '%')
                ->orWhere('hasil', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Order by latest
        $penanganan = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.penanganan.index', compact('penanganan'));
    }

    /**
     * Show the form for creating a new penanganan.
     */
    public function create()
    {
        $pengaduan = Pengaduan::orderBy('tanggal', 'desc')->get();
        $petugas = Petugas::orderBy('nama', 'asc')->get();
        return view('admin.penanganan.create', compact('pengaduan', 'petugas'));
    }

    /**
     * Store a newly created penanganan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'petugas_id' => ['required', 'exists:petugas,id'],
            'tanggal' => ['required', 'date'],
            'tindakan' => ['required', 'string'],
            'hasil' => ['required', 'string'],
            'status' => ['required', 'in:pending,diproses,selesai'],
        ]);

        $penanganan = Penanganan::create($validated);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah penanganan baru #{$penanganan->id}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.penanganan')
            ->with('success', 'Data Penanganan berhasil ditambahkan!');
    }

    /**
     * Display the specified penanganan.
     */
    public function show(Penanganan $penanganan)
    {
        $penanganan->load(['pengaduan', 'petugas']);
        return view('admin.penanganan.show', compact('penanganan'));
    }

    /**
     * Show the form for editing the specified penanganan.
     */
    public function edit(Penanganan $penanganan)
    {
        $pengaduan = Pengaduan::orderBy('tanggal', 'desc')->get();
        $petugas = Petugas::orderBy('nama', 'asc')->get();
        return view('admin.penanganan.edit', compact('penanganan', 'pengaduan', 'petugas'));
    }

    /**
     * Update the specified penanganan in storage.
     */
    public function update(Request $request, Penanganan $penanganan)
    {
        $validated = $request->validate([
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'petugas_id' => ['required', 'exists:petugas,id'],
            'tanggal' => ['required', 'date'],
            'tindakan' => ['required', 'string'],
            'hasil' => ['required', 'string'],
            'status' => ['required', 'in:pending,diproses,selesai'],
        ]);

        $penanganan->update($validated);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Memperbarui penanganan #{$penanganan->id}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.penanganan')
            ->with('success', 'Data Penanganan berhasil diperbarui!');
    }

    /**
     * Remove the specified penanganan from storage.
     */
    public function destroy(Request $request, Penanganan $penanganan)
    {
        $penangananId = $penanganan->id;
        $penanganan->delete();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menghapus penanganan #{$penangananId}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.penanganan')
            ->with('success', 'Data Penanganan berhasil dihapus!');
    }
}
