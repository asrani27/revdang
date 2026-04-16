<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogAktivitasController extends Controller
{
    /**
     * Display a listing of log aktivitas.
     */
    public function index(Request $request)
    {
        $query = LogAktivitas::with('user');

        // Search by user name or aktivitas
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', '%' . $search . '%')
                       ->orWhere('username', 'like', '%' . $search . '%');
                })
                ->orWhere('aktivitas', 'like', '%' . $search . '%');
            });
        }

        // Filter by modul
        if ($request->has('modul') && $request->modul !== '') {
            $query->where('modul', $request->modul);
        }

        // Filter by role
        if ($request->has('role') && $request->role !== '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to !== '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Order by latest
        $logAktivitas = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.log-aktivitas.index', compact('logAktivitas'));
    }

    /**
     * Display the specified log aktivitas.
     */
    public function show(LogAktivitas $logAktivitas)
    {
        $logAktivitas->load('user');
        return view('admin.log-aktivitas.show', compact('logAktivitas'));
    }

    /**
     * Log user activity (static method for use anywhere)
     */
    public static function log(string $aktivitas, ?string $modul = null)
    {
        $user = Auth::user();
        
        if (!$user) {
            return null;
        }

        return LogAktivitas::create([
            'user_id' => $user->id,
            'aktivitas' => $aktivitas,
            'modul' => $modul ?? 'general',
            'IP_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Clear all log aktivitas (for admin)
     */
    public function clearAll()
    {
        LogAktivitas::truncate();
        
        return redirect()->route('admin.data.log-aktivitas')
            ->with('success', 'Semua log aktivitas berhasil dihapus!');
    }

    /**
     * Delete log older than specified days
     */
    public function clearOld(int $days = 30)
    {
        $cutoffDate = now()->subDays($days);
        $deleted = LogAktivitas::where('created_at', '<', $cutoffDate)->delete();
        
        return redirect()->route('admin.data.log-aktivitas')
            ->with('success', $deleted . ' log aktivitas lama berhasil dihapus!');
    }
}
