<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemaKid extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nama', 'waktu', 'kid_id'];
    // protected $with = ['kid', 'detailTema'];

    public function kid(): BelongsTo
    {
        return $this->belongsTo(Kid::class);
    }

    public function detailTema(): HasMany
    {
        return $this->hasMany(DetailTemaKid::class);
    }
}
