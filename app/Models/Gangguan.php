<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gangguan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_gangguan', 'deskripsi'];
    protected $table = 'gangguan';

    /**
     * Get the pengaduan for this gangguan.
     */
    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
