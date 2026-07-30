<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title_vi', 'title_en', 'slug_vi', 'slug_en',
        'excerpt_vi', 'excerpt_en', 'content_vi', 'content_en',
        'featured_image', 'location_vi', 'location_en',
        'organizer_vi', 'organizer_en', 'format_vi', 'format_en',
        'registration_url', 'attachment', 'starts_at', 'ends_at',
        'program_status', 'status', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')->orderBy('sort_order')->orderByDesc('starts_at');
    }
}
