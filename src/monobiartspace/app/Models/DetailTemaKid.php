<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTemaKid extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['week', 'nama', 'tema_kid_id'];

    public function tema(): BelongsTo
    {
        return $this->belongsTo(TemaKid::class);
    }
}
