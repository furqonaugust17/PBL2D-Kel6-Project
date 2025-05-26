<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanArtSpace extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nama', 'harga', 'artspace_id'];
    // protected $with = ['artspace'];

    public function artspace(): BelongsTo
    {
        return $this->belongsTo(ArtSpace::class);
    }
}
