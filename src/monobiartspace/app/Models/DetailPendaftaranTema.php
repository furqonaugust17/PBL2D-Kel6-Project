<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPendaftaranTema extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['detail_pendaftaran_id', 'tema_id'];
}
