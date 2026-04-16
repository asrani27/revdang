<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Pelanggan;
use App\Models\Gangguan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the pengaduan.
     */
    public function index(Request $request)
    {
        $query = Pengaduan::with(['pelanggan', 'gangguan']);

        // Search by pelanggan name, gangguan name, or lokasi
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pelanggan', function ($pq) use ($search) {
                    $pq->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhereHas('gangguan', function ($gq) use ($search) {
                    $gq->where('nama_gangguan', 'like', '%' . $search . '%');
                })
                ->orWhere('lokasi', 'like', '%' . $search . '%')
                ->orWhere('keluhan', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Order by latest
        $pengaduan = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new pengaduan.
     */
    public function create()
    {
        $pelanggan = Pelanggan::orderBy('nama', 'asc')->get();
        $gangguan = Gangguan::orderBy('nama_gangguan', 'asc')->get();
        return view('admin.pengaduan.create', compact('pelanggan', 'gangguan'));
    }

    /**
     * Store a newly created pengaduan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => ['required', 'exists:pelanggan,id'],
            'gangguan_id' => ['required', 'exists:gangguan,id'],
            'tanggal' => ['required', 'date'],
            'keluhan' => ['required', 'string'],
            'lokasi' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:menunggu,diproses,selesai,ditolak'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/pengaduan'), $filename);
            $validated['foto'] = $filename;
        }

        $pengaduan = Pengaduan::create($validated);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah pengaduan baru #{$pengaduan->id} - {$pengaduan->keluhan}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.pengaduan')
            ->with('success', 'Data Pengaduan berhasil ditambahkan!');
    }

    /**
     * Display the specified pengaduan.
     */
    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['pelanggan', 'gangguan']);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified pengaduan.
     */
    public function edit(Pengaduan $pengaduan)
    {
        $pelanggan = Pelanggan::orderBy('nama', 'asc')->get();
        $gangguan = Gangguan::orderBy('nama_gangguan', 'asc')->get();
        return view('admin.pengaduan.edit', compact('pengaduan', 'pelanggan', 'gangguan'));
    }

    /**
     * Update the specified pengaduan in storage.
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'pelanggan_id' => ['required', 'exists:pelanggan,id'],
            'gangguan_id' => ['required', 'exists:gangguan,id'],
            'tanggal' => ['required', 'date'],
            'keluhan' => ['required', 'string'],
            'lokasi' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:menunggu,diproses,selesai,ditolak'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($pengaduan->foto && file_exists(public_path('uploads/pengaduan/' . $pengaduan->foto))) {
                unlink(public_path('uploads/pengaduan/' . $pengaduan->foto));
            }
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/pengaduan'), $filename);
            $validated['foto'] = $filename;
        }

        $pengaduan->update($validated);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Memperbarui pengaduan #{$pengaduan->id} - Status: {$pengaduan->status}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.pengaduan')
            ->with('success', 'Data Pengaduan berhasil diperbarui!');
    }

    /**
     * Remove the specified pengaduan from storage.
     */
    public function destroy(Request $request, Pengaduan $pengaduan)
    {
        $pengaduanId = $pengaduan->id;
        
        // Delete foto if exists
        if ($pengaduan->foto && file_exists(public_path('uploads/pengaduan/' . $pengaduan->foto))) {
            unlink(public_path('uploads/pengaduan/' . $pengaduan->foto));
        }
        
        $pengaduan->delete();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menghapus pengaduan #{$pengaduanId}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.pengaduan')
            ->with('success', 'Data Pengaduan berhasil dihapus!');
    }
}
