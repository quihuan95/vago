<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name_vi', 'name_en', 'position_vi', 'position_en',
        'title_vi', 'title_en', 'organization_vi', 'organization_en',
        'photo', 'bio_vi', 'bio_en', 'term', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
