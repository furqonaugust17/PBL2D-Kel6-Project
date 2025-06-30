<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ruang';
    protected $fillable = ['nama', 'kapasitas', 'deskripsi'];

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class);
    }
}
