<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fasilitas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fasilitas'; 
    protected $fillable = ['id_ruang', 'nama_fasilitas'];
    protected $with = ['ruang'];

    public function ruang():BelongsTo
    {
        return $this->belongsTo(Ruang::class, 'id_ruang');
    }
}
