<?php

namespace App\Http\Controllers;

use App\Support\Locale;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $validated = in_array($locale, [Locale::VI, Locale::EN], true) ? $locale : Locale::VI;

        $request->session()->put('locale', $validated);

        return redirect()->to(url()->previous() ?: route('home'));
    }
}
