<?php

namespace App\Support;

class Vago2026
{
    public const DEV_URL = 'https://vago2026.test';

    public const PRODUCTION_URL = 'https://vago2026.websitehoinghi.com/vi';

    public static function url(): string
    {
        return app()->isLocal() ? self::DEV_URL : self::PRODUCTION_URL;
    }
}
