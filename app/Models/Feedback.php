<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['pengaduan_id', 'rating', 'komentar'];
    protected $table = 'feedback';

    /**
     * Get the pengaduan that owns the feedback.
     */
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }

    /**
     * Get rating stars for display
     */
    public function getRatingStarsAttribute(): string
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<span class="text-yellow-400">★</span>';
            } else {
                $stars .= '<span class="text-slate-300 dark:text-slate-600">★</span>';
            }
        }
        return $stars;
    }

    /**
     * Get rating badge color
     */
    public function getRatingBadgeColorAttribute(): string
    {
        return match($this->rating) {
            1 => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
            2 => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
            3 => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
            4 => 'bg-lime-100 text-lime-700 dark:bg-lime-900/30 dark:text-lime-400',
            5 => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
            default => 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300',
        };
    }
}
