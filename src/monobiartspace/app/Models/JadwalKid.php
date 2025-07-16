<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalKid extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['hari', 'mulai', 'akhir', 'kategori_id', 'kapasitas'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriKid::class);
    }
}
