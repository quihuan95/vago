<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title_vi', 'title_en', 'description_vi', 'description_en',
        'image_desktop', 'image_mobile', 'link_url', 'open_in_new_tab',
        'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'open_in_new_tab' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
