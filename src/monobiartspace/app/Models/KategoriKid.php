<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriKid extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nama', 'deskripsi', 'kid_id'];
    // protected $with = ['kid'];

    public function kid(): BelongsTo
    {
        return $this->belongsTo(Kid::class);
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(JadwalKid::class, 'kategori_id');
    }
}
