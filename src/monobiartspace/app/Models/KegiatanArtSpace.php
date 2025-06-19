<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KegiatanArtSpace extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['slug', 'nama', 'deskripsi', 'harga', 'artspace_id'];
    protected $with = ['artspace'];

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

    public function artspace(): BelongsTo
    {
        return $this->belongsTo(ArtSpace::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(KegiatanArtSpaceImages::class);
    }
}
