<?php

namespace App\Support;

class Locale
{
    public const VI = 'vi';

    public const EN = 'en';

    public static function current(): string
    {
        $locale = app()->getLocale();

        return in_array($locale, [self::VI, self::EN], true) ? $locale : self::VI;
    }

    public static function isEnglish(): bool
    {
        return self::current() === self::EN;
    }

    public static function field(string $base): string
    {
        return $base.'_'.self::current();
    }

    public static function other(): string
    {
        return self::isEnglish() ? self::VI : self::EN;
    }
}
