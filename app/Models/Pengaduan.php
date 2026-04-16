<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = ['pelanggan_id', 'gangguan_id', 'tanggal', 'keluhan', 'lokasi', 'status', 'foto'];
    protected $table = 'pengaduan';
    protected $casts = [
        'tanggal' => 'datetime',
    ];

    /**
     * Get the pelanggan that owns the pengaduan.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /**
     * Get the gangguan that owns the pengaduan.
     */
    public function gangguan(): BelongsTo
    {
        return $this->belongsTo(Gangguan::class);
    }

    /**
     * Get the feedback for this pengaduan.
     */
    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'menunggu' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
            'diproses' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'selesai' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
            'ditolak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
            default => 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300',
        };
    }
}