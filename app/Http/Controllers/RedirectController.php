<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Support\Vago2026;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    public function vago2026(): RedirectResponse
    {
        return redirect()->away(Vago2026::url());
    }

    public function journal(): RedirectResponse
    {
        $url = Setting::getValue('journal_url', 'https://vjog.vn/journal');

        return redirect()->away($url);
    }
}
