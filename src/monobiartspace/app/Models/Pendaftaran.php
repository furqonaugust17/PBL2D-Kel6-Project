<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['type', 'customer_id', 'nominal', 'diskon', 'tanggal_reservasi', 'sesi', 'status'];
    // protected $with = ['detailPendaftaran', 'detailPendaftaranKid'];

    public function pembayaran(): HasOne
    {
        return $this->hasOne(PembayaranBooking::class);
    }

    public function sesis(): BelongsTo
    {
        return $this->belongsTo(JadwalArtSpace::class, 'sesi');
    }

    public function detailPendaftaran(): HasMany
    {
        return $this->hasMany(DetailPendaftaran::class, 'pendaftaran_id');
    }

    public function detailPendaftaranKid(): HasOne
    {
        return $this->hasOne(DetailPendaftaranKid::class, 'pendaftaran_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
