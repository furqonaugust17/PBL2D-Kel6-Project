<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Children extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['parent_id', 'nama_lengkap', 'panggilan', 'tgl_lahir'];
}
