<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlbumImage extends Model
{
    use HasTranslations;

    protected $fillable = [
        'album_id', 'image_path', 'alt_vi', 'alt_en',
        'caption_vi', 'caption_en', 'sort_order', 'is_cover',
    ];

    protected function casts(): array
    {
        return [
            'is_cover' => 'boolean',
        ];
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
