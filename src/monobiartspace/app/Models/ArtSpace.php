<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtSpace extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nama'];

    public function kegiatan(): HasMany
    {
        return $this->hasMany(KegiatanArtSpace::class, 'artspace_id');
    }
}
