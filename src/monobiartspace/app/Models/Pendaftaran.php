<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['type', 'customer_id', 'total_price', 'tanggal_reservasi', 'schedule_id'];
    protected $with = ['detailPendaftaran'];

    public function detailPendaftaran(): HasMany
    {
        return $this->hasMany(DetailPendaftaran::class, 'pendaftaran_id');
    }
}
