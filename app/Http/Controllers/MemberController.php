<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberApplicationRequest;
use App\Mail\MemberApplicationSubmitted;
use App\Models\MemberApplication;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function theLe(): View
    {
        $page = Page::query()
            ->published()
            ->where(function ($query) {
                $query->where('type', 'the-le')
                    ->orWhereIn('slug_vi', ['the-le', 'the-le-hoi-vien'])
                    ->orWhereIn('slug_en', ['the-le', 'membership-regulations']);
            })
            ->first();

        return view('pages.member.the-le', compact('page'));
    }

    public function registerForm(): View
    {
        return view('pages.member.register');
    }

    public function store(StoreMemberApplicationRequest $request): RedirectResponse
    {
        $data = $request->safeData();
        $data['ip_address'] = $request->ip();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('member-applications', 'public');
        }

        $application = MemberApplication::create($data);

        $notifyEmail = Setting::getValue('notification_email');

        if ($notifyEmail) {
            Mail::to($notifyEmail)->send(new MemberApplicationSubmitted($application));
        }

        return back()->with('member_success', __('site.member_success'));
    }
}
