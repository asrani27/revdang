<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gangguan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_gangguan', 'deskripsi'];
    protected $table = 'gangguan';
}