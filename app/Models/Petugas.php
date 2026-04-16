<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Petugas extends Model
{
    use HasFactory;

    protected $fillable = ['nik', 'nama', 'jabatan', 'telp', 'user_id'];
    protected $table = 'petugas';

    /**
     * Get the user that owns the petugas.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get nik display attribute
     */
    public function getNikDisplayAttribute(): string
    {
        return $this->nik;
    }

    /**
     * Get telepon display attribute
     */
    public function getTeleponDisplayAttribute(): string
    {
        return $this->telp ?? '-';
    }
}