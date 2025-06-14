<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HargaClassKid extends Model
{
    use SoftDeletes;
    protected $fillable = ['kid_id', 'harga', 'jumlah_pertemuan', 'deskripsi'];

    public function kid(): BelongsTo
    {
        return $this->belongsTo(Kid::class);
    }
}
