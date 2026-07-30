<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    public function vago2026(): RedirectResponse
    {
        $url = Setting::getValue('vago2026_url', 'https://vago2026.websitehoinghi');

        return redirect()->away($url);
    }

    public function journal(): RedirectResponse
    {
        $url = Setting::getValue('journal_url', 'https://vjog.vn/journal');

        return redirect()->away($url);
    }
}
