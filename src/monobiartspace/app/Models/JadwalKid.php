<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalKid extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['hari', 'mulai', 'akhir', 'kid_id'];
    protected $with = ['kid'];

    public function kid(): BelongsTo
    {
        return $this->belongsTo(Kid::class);
    }
}
