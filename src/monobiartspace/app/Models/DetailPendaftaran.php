<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPendaftaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['pendaftaran_id', 'nama_peserta', 'kegiatan'];

    public function kegiatans(): BelongsTo
    {
        return $this->belongsTo(KegiatanArtSpace::class, 'kegiatan');
    }
}
