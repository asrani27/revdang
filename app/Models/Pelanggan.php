<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = ['nik', 'nama', 'alamat', 'telp', 'daya', 'nomor_meter', 'user_id'];
    protected $table = 'pelanggan';

    /**
     * Get the user that owns the pelanggan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}