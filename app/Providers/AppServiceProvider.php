<?php

namespace App\Providers;

use App\Models\Setting;
use App\Support\Locale;
use App\Support\Vago2026;
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
        $this->app->booted(function () {
            if (! $this->app->bound('view')) {
                return;
            }

            View::composer('*', function ($view) {
                try {
                    $journalUrl = Setting::getValue('journal_url', 'https://vjog.vn/journal');
                } catch (\Throwable) {
                    $journalUrl = 'https://vjog.vn/journal';
                }

                $view->with([
                    'currentLocale' => Locale::current(),
                    'vago2026Url' => Vago2026::url(),
                    'journalUrl' => $journalUrl,
                ]);
            });
        });
    }
}
