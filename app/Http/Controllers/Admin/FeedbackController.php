<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Pengaduan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedback.
     */
    public function index(Request $request)
    {
        $query = Feedback::with(['pengaduan.pelanggan', 'pengaduan.gangguan']);

        // Search by pelanggan name, pengaduan id, or komentar
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pengaduan.pelanggan', function ($pq) use ($search) {
                    $pq->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhereHas('pengaduan', function ($pq) use ($search) {
                    $pq->where('id', 'like', '%' . $search . '%');
                })
                ->orWhere('komentar', 'like', '%' . $search . '%');
            });
        }

        // Filter by rating
        if ($request->has('rating') && $request->rating !== '') {
            $query->where('rating', $request->rating);
        }

        // Order by latest
        $feedback = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.feedback.index', compact('feedback'));
    }

    /**
     * Show the form for creating a new feedback.
     */
    public function create()
    {
        $pengaduan = Pengaduan::with(['pelanggan', 'gangguan'])
            ->whereDoesntHave('feedback')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.feedback.create', compact('pengaduan'));
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['nullable', 'string'],
        ]);

        $feedback = Feedback::create($validated);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah feedback baru #{$feedback->id} - Rating: {$feedback->rating}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.feedback')
            ->with('success', 'Data Feedback berhasil ditambahkan!');
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedback $feedback)
    {
        $feedback->load(['pengaduan.pelanggan', 'pengaduan.gangguan']);
        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified feedback.
     */
    public function edit(Feedback $feedback)
    {
        $pengaduan = Pengaduan::with(['pelanggan', 'gangguan'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.feedback.edit', compact('feedback', 'pengaduan'));
    }

    /**
     * Update the specified feedback in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['nullable', 'string'],
        ]);

        $feedback->update($validated);

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Memperbarui feedback #{$feedback->id} - Rating: {$feedback->rating}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.feedback')
            ->with('success', 'Data Feedback berhasil diperbarui!');
    }

    /**
     * Remove the specified feedback from storage.
     */
    public function destroy(Request $request, Feedback $feedback)
    {
        $feedbackId = $feedback->id;
        $feedback->delete();

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menghapus feedback #{$feedbackId}",
            'modul' => 'admin',
            'IP_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.data.feedback')
            ->with('success', 'Data Feedback berhasil dihapus!');
    }
}
