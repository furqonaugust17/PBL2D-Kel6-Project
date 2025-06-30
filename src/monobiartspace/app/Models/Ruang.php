<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ruang';
<<<<<<< HEAD
    protected $fillable = ['nama', 'kapasitas'];

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class);
    }
=======
    protected $fillable = ['nama', 'kapasitas', 'deskripsi'];
>>>>>>> a95fdf11e4af06a1494869033f1a241c438a8182
}
