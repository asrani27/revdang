<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penanganan extends Model
{
    use HasFactory;

    protected $fillable = ['pengaduan_id', 'petugas_id', 'tanggal', 'tindakan', 'hasil', 'status'];
    protected $table = 'penanganan';
    protected $casts = [
        'tanggal' => 'datetime',
    ];

    /**
     * Get the pengaduan that owns the penanganan.
     */
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }

    /**
     * Get the petugas that owns the penanganan.
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class);
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
            'diproses' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'selesai' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
            default => 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300',
        };
    }
}