<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kid extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nama'];

    public function kategories(): HasMany
    {
        return $this->hasMany(KategoriKid::class);
    }

    public function temas(): HasMany
    {
        return $this->hasMany(TemaKid::class);
    }
}
