<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactSubmitted;
use App\Models\ContactSubmission;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        $data = $request->safeData();
        $data['ip_address'] = $request->ip();

        $submission = ContactSubmission::create($data);

        $notifyEmail = Setting::getValue('notification_email');

        if ($notifyEmail) {
            Mail::to($notifyEmail)->send(new ContactSubmitted($submission));
        }

        return back()->with('contact_success', __('site.contact_success'));
    }
}
