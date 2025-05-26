<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPendaftaranTema extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['detail_pendaftaran_id', 'tema_id'];
    // protected $with = ['detailPendaftaranKid'];


    public function detailPendaftaranKid(): BelongsTo
    {
        return $this->belongsTo(DetailPendaftaranKid::class);
    }

    public function tema(): BelongsTo
    {
        return $this->belongsTo(DetailTemaKid::class, 'tema_id');
    }
}
