<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KegiatanArtSpaceImages extends Model
{
    protected $fillable = ['kegiatan_art_space_id', 'file'];

    public function kegiatans(): BelongsTo
    {
        return $this->belongsTo(KegiatanArtSpace::class);
    }
}
