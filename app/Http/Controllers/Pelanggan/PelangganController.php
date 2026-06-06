<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Gangguan;
use App\Models\Feedback;
use App\Models\Pengaduan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Display the pelanggan dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        // Handle case when pelanggan is not found
        if (!$pelanggan) {
            return view('pelanggan.dashboard', [
                'totalPengaduan' => 0,
                'sedangDiproses' => 0,
                'selesai' => 0,
                'recentPengaduan' => collect([]),
            ]);
        }
        
        // Get pengaduan statistics
        $totalPengaduan = Pengaduan::where('pelanggan_id', $pelanggan->id)->count();
        $sedangDiproses = Pengaduan::where('pelanggan_id', $pelanggan->id)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->count();
        $selesai = Pengaduan::where('pelanggan_id', $pelanggan->id)
            ->where('status', 'selesai')
            ->count();
        
        // Get recent pengaduan
        $recentPengaduan = Pengaduan::where('pelanggan_id', $pelanggan->id)
            ->with('gangguan')
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();
        
        return view('pelanggan.dashboard', compact(
            'totalPengaduan',
            'sedangDiproses',
            'selesai',
            'recentPengaduan'
        ));
    }
    
    /**
     * Display list of pengaduan for this pelanggan
     */
    public function pengaduanIndex(Request $request)
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            return view('pelanggan.pengaduan.index', ['pengaduan' => collect([])]);
        }
        
        $query = Pengaduan::where('pelanggan_id', $pelanggan->id)
            ->with('gangguan');
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('keluhan', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }
        
        $pengaduan = $query->orderBy('tanggal', 'desc')->paginate(10);
        
        return view('pelanggan.pengaduan.index', compact('pengaduan'));
    }
    
    /**
     * Show detail of a pengaduan
     */
    public function pengaduanShow($id)
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
        $pengaduan = Pengaduan::where('id', $id)
            ->where('pelanggan_id', $pelanggan->id)
            ->with(['gangguan', 'feedback'])
            ->firstOrFail();
        
        return view('pelanggan.pengaduan.show', compact('pengaduan'));
    }
    
    /**
     * Show form to create new pengaduan
     */
    public function pengaduanCreate()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
        $gangguan = Gangguan::all();
        return view('pelanggan.pengaduan.create', compact('gangguan'));
    }
    
    /**
     * Store new pengaduan
     */
    public function pengaduanStore(Request $request)
    {
        $request->validate([
            'gangguan_id' => 'required|exists:gangguan,id',
            'keluhan' => 'required|string|max:1000',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan.');
        }
        
        $data = [
            'pelanggan_id' => $pelanggan->id,
            'gangguan_id' => $request->gangguan_id,
            'tanggal' => now(),
            'keluhan' => $request->keluhan,
            'lokasi' => $request->lokasi,
            'status' => 'menunggu',
        ];
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }
        
        Pengaduan::create($data);
        
        return redirect()->route('pelanggan.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim. Kami akan segera meninjaunya.');
    }
    
    /**
     * Display list of gangguan for this pelanggan
     */
    public function gangguanIndex(Request $request)
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            return view('pelanggan.gangguan.index', ['gangguan' => collect([])]);
        }
        
        // Get gangguan history that affected this pelanggan
        $query = Gangguan::whereHas('pengaduan', function($q) use ($pelanggan) {
            $q->where('pelanggan_id', $pelanggan->id);
        });
        
        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_gangguan', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }
        
        $gangguan = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('pelanggan.gangguan.index', compact('gangguan'));
    }
    
    /**
     * Show detail of a gangguan
     */
    public function gangguanShow($id)
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
        $gangguan = Gangguan::with(['pengaduan' => function($q) use ($pelanggan) {
            $q->where('pelanggan_id', $pelanggan->id);
        }])->findOrFail($id);
        
        // Check if this gangguan belongs to this pelanggan
        if ($gangguan->pengaduan->isEmpty()) {
            abort(403, 'Anda tidak memiliki akses ke gangguan ini.');
        }
        
        return view('pelanggan.gangguan.show', compact('gangguan'));
    }
    
    /**
     * Show form to create feedback
     */
    public function feedbackCreate(Request $request)
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
        // Get completed pengaduan that don't have feedback yet
        $pengaduanList = Pengaduan::where('pelanggan_id', $pelanggan->id)
            ->where('status', 'selesai')
            ->whereDoesntHave('feedback')
            ->orderBy('tanggal', 'desc')
            ->get();
        
        // If pengaduan_id is specified, use that one
        $selectedPengaduan = null;
        if ($request->has('pengaduan_id')) {
            $selectedPengaduan = Pengaduan::where('id', $request->pengaduan_id)
                ->where('pelanggan_id', $pelanggan->id)
                ->first();
        }
        
        return view('pelanggan.feedback.create', compact('pengaduanList', 'selectedPengaduan'));
    }
    
    /**
     * Store feedback
     */
    public function feedbackStore(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);
        
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan.');
        }
        
        // Verify pengaduan belongs to this pelanggan
        $pengaduan = Pengaduan::where('id', $request->pengaduan_id)
            ->where('pelanggan_id', $pelanggan->id)
            ->firstOrFail();
        
        // Check if feedback already exists
        if ($pengaduan->feedback) {
            return redirect()->back()
                ->with('error', 'Feedback untuk pengaduan ini sudah ada.');
        }
        
        Feedback::create([
            'pengaduan_id' => $request->pengaduan_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);
        
        return redirect()->route('pelanggan.dashboard')
            ->with('success', 'Terima kasih atas feedback Anda!');
    }
    
    /**
     * Show feedback history
     */
    public function feedbackIndex()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan ?? null;
        
        if (!$pelanggan) {
            return view('pelanggan.feedback.index', ['feedback' => collect([])]);
        }
        
        $feedback = Feedback::whereHas('pengaduan', function($q) use ($pelanggan) {
            $q->where('pelanggan_id', $pelanggan->id);
        })
        ->with('pengaduan.gangguan')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('pelanggan.feedback.index', compact('feedback'));
    }
}