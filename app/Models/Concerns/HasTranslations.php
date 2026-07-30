<?php

namespace App\Models\Concerns;

use App\Support\Locale;

trait HasTranslations
{
    public function t(string $attribute, ?string $fallback = null): ?string
    {
        $locale = Locale::current();
        $primary = $this->getAttribute("{$attribute}_{$locale}");

        if (filled($primary)) {
            return $primary;
        }

        $other = $locale === Locale::VI ? Locale::EN : Locale::VI;
        $secondary = $this->getAttribute("{$attribute}_{$other}");

        if (filled($secondary)) {
            return $secondary;
        }

        return $fallback;
    }

    public function localizedSlug(): ?string
    {
        return $this->t('slug') ?: $this->getAttribute('slug_vi');
    }
}
