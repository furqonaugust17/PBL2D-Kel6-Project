<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemaImages extends Model
{
    protected $fillable = ['tema_kid_id', 'file'];

    public function temas(): BelongsTo
    {
        return $this->belongsTo(TemaKid::class);
    }
}
