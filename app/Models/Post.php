<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasTranslations;
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'author_id',
        'title_vi', 'title_en', 'slug_vi', 'slug_en',
        'excerpt_vi', 'excerpt_en', 'content_vi', 'content_en',
        'featured_image', 'attachment', 'is_featured', 'status', 'published_at',
        'seo_title_vi', 'seo_title_en', 'seo_description_vi', 'seo_description_en', 'og_image',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}
