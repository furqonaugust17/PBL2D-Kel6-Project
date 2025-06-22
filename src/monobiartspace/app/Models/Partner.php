<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Partner extends Model
{
    //
    use HasFactory, Notifiable;
    protected $table = 'partners';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'image',
        'description',
    ];
}
