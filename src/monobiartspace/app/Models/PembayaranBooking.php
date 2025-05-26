<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranBooking extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['order_id', 'pendaftaran_id', 'payment_date', 'amount',  'payment_method', 'status', 'snap_token', 'snap_url'];
    // protected $with = ['pendaftaran'];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
