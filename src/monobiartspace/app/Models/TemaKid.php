<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TemaKid extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['slug', 'nama', 'deskripsi', 'waktu', 'kid_id', 'is_active'];
    protected $with = ['kid', 'detailTema'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $slug = Str::slug($model->nama);
            $count = 1;

            while (static::withTrashed()->where('slug', $slug)->exists()) {
                $slug = Str::slug($model->nama) . '-' . $count++;
            }

            $model->slug = $slug;
        });
    }

    public function kid(): BelongsTo
    {
        return $this->belongsTo(Kid::class);
    }

    public function detailTema(): HasMany
    {
        return $this->hasMany(DetailTemaKid::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(TemaImages::class);
    }
}
