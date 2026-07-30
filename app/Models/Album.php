<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title_vi', 'title_en', 'slug_vi', 'slug_en',
        'description_vi', 'description_en', 'cover_image',
        'event_date', 'status', 'sort_order',
        'seo_title_vi', 'seo_title_en', 'seo_description_vi', 'seo_description_en',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(AlbumImage::class)->orderBy('sort_order');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')->orderByDesc('event_date')->orderBy('sort_order');
    }
}
