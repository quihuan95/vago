<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasTranslations;

    protected $fillable = [
        'parent_id', 'type',
        'title_vi', 'title_en', 'slug_vi', 'slug_en',
        'excerpt_vi', 'excerpt_en', 'content_vi', 'content_en',
        'featured_image', 'status', 'sort_order',
        'seo_title_vi', 'seo_title_en', 'seo_description_vi', 'seo_description_en',
        'og_image', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where(function (Builder $q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }
}
