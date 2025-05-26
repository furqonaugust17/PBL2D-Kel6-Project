<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPendaftaranKid extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['pendaftaran_id', 'children_id', 'jadwal_id'];
    // protected $with = ['pendaftaran', 'detailPendaftaranTema'];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function detailPendaftaranTema(): HasMany
    {
        return $this->hasMany(DetailPendaftaranTema::class, 'detail_pendaftaran_id');
    }

    public function jadwalKid(): BelongsTo
    {
        return $this->belongsTo(JadwalKid::class, 'jadwal_id');
    }

    public function children(): BelongsTo
    {
        return $this->belongsTo(Children::class);
    }
}
