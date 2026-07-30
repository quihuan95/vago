<?php

namespace App\Providers;

use App\Models\Setting;
use App\Support\Locale;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with([
                'currentLocale' => Locale::current(),
                'vago2026Url' => Setting::getValue('vago2026_url', 'https://vago2026.websitehoinghi'),
                'journalUrl' => Setting::getValue('journal_url', 'https://vjog.vn/journal'),
            ]);
        });
    }
}
